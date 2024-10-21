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
        $this->middleware('permission:ver-usuario|crear-usuario|editar-usuario|borrar-usuario', ['only' => ['index']]);
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
        // Validar datos
        $request->validate([
            'nombre' => 'required|string|max:100',
            'correo' => 'required|string|email|max:100|unique:usuarios,correo,' . $idUsuario . ',idUsuario',
            'telefono' => 'nullable|string|max:20',
            'contrasena' => 'nullable|string|min:8|confirmed',
            'roles' => 'required|array|min:1', // Asegúrate de que se esté enviando al menos un rol
            'roles.*' => 'exists:roles,name', // Verifica que los roles existan en la tabla de roles
        ]);

        try {
            // Encontrar el usuario
            $usuario = Usuario::findOrFail($idUsuario);

            // Preparar datos para actualizar
            $data = [
                'nombre' => $request->nombre,
                'correo' => $request->correo,
                'telefono' => $request->telefono,
            ];

            // Si se proporciona una nueva contraseña, la actualizamos
            if ($request->filled('contrasena')) {
                $data['contrasena'] = Hash::make($request->contrasena);
            }

            // Actualizar los datos del usuario
            $usuario->update($data);

            // Asignar los nuevos roles
            $roles = $request->input('roles'); // Obtener el array de roles del formulario
            $usuario->syncRoles($roles);

            return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado con éxito.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al actualizar el usuario: ' . $e->getMessage());
        }
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
