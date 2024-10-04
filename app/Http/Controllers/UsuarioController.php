<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use Spatie\Permission\Models\Role; // Asegúrate de incluir este uso
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:ver-usuario|crear-usuario|editar-usuario|borrar-usuario')->only('index');
        $this->middleware('permission:crear-usuario', ['only' => ['create', 'store']]);
        $this->middleware('permission:editar-usuario', ['only' => ['edit', 'update']]);
        $this->middleware('permission:borrar-usuario', ['only' => ['destroy']]);
    }

    /**
     * Mostrar todos los usuarios.
     */
    public function index()
    {
        $usuarios = Usuario::all(); // Cambia a paginación
        return view('usuarios.index', compact('usuarios'));
    }

    /**
     * Mostrar el formulario para crear un nuevo usuario.
     */
    public function create()
    {
        $roles = Role::all(); // Obtener todos los roles
        return view('usuarios.create', compact('roles')); // Pasar roles a la vista
    }

    /**
     * Almacenar un nuevo usuario en la base de datos.
     */
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'nombre' => 'required|string|max:100',
            'correo' => 'required|string|email|max:100|unique:usuarios,correo',
            'contrasena' => 'required|string|min:8|confirmed',
            'telefono' => 'nullable|string|max:20',
            'roles' => 'required|array', // Asegúrate de que se seleccione al menos un rol
        ]);
    
        try {
            // Crear un nuevo usuario
            $usuario = Usuario::create([
                'nombre' => $request->nombre,
                'correo' => $request->correo,
                'contrasena' => Hash::make($request->contrasena),
                'telefono' => $request->telefono,
            ]);
    
            // Asignar roles al usuario
            $usuario->assignRole($request->input('roles'));
    
            return redirect()->route('usuarios.index')->with('success', 'Usuario creado con éxito.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al crear el usuario: ' . $e->getMessage());
        }
    }
    /**
     * Mostrar los detalles de un usuario específico.
     */
    public function show($id)
    {
        $usuario = Usuario::findOrFail($id); // Encuentra el usuario o devuelve un error 404
        return view('usuarios.show', compact('usuario')); // Devuelve la vista con el usuario
    }
    /**
     * Mostrar el formulario para editar un usuario existente.
     */
    public function edit($idUsuario)
    {
        $usuario = Usuario::findOrFail($idUsuario); // Encuentra el usuario o devuelve un error 404
        $roles = Role::all(); // Obtener todos los roles
        $userRole = $usuario->getRoleNames(); // Obtener los roles asignados al usuario

        return view('usuarios.edit', compact('usuario', 'roles', 'userRole'));
    }

    /**
     * Actualizar un usuario en la base de datos.
     */
    public function update(Request $request, $idUsuario)
    {
        // Validar los datos del formulario
        $request->validate([
            'nombre' => 'required|string|max:100',
            'correo' => 'required|string|email|max:100|unique:usuarios,correo,'.$idUsuario,
            'telefono' => 'nullable|string|max:20',
            'contrasena' => 'nullable|string|min:8|confirmed', // No es obligatorio cambiar la contraseña
            'roles' => 'required|array', // Asegúrate de que se seleccione al menos un rol
        ]);

        // Buscar el usuario en la base de datos
        $usuario = Usuario::findOrFail($idUsuario);

        // Actualizar los datos del usuario
        $usuario->update([
            'nombre' => $request->nombre,
            'correo' => $request->correo,
            'telefono' => $request->telefono,
            'contrasena' => $request->contrasena ? Hash::make($request->contrasena) : $usuario->contrasena, // Actualiza la contraseña solo si se proporciona
        ]);

        // Sincronizar roles
        $usuario->syncRoles($request->input('roles'));

        return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado con éxito.');
    }

    /**
     * Eliminar un usuario específico.
     */
    public function destroy($idUsuario)
    {
        $usuario = Usuario::findOrFail($idUsuario); // Encuentra el usuario o devuelve un error 404
        $usuario->delete(); // Elimina el usuario

        return redirect()->route('usuarios.index')->with('success', 'Usuario eliminado con éxito.');
    }
}
