<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    /**
     * Mostrar todos los usuarios.
     */
    public function index()
    {
        $usuarios = Usuario::all(); // Trae todos los usuarios
        return view('usuarios.index', compact('usuarios')); // Devuelve una vista con los usuarios
    }

    /**
     * Mostrar el formulario para crear un nuevo usuario.
     */
    public function create()
    {
        return view('usuarios.create'); // Devuelve la vista de creación
    }

    /**
     * Guardar un nuevo usuario en la base de datos.
     */
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'nombre' => 'required|string|max:100',
            'correo' => 'required|string|email|max:100|unique:usuarios,correo',
            'contrasena' => 'required|string|min:8|confirmed',
            'telefono' => 'nullable|string|max:20',
        ]);

        // Crear un nuevo usuario
        Usuario::create([
            'nombre' => $request->nombre,
            'correo' => $request->correo,
            'contrasena' => Hash::make($request->contrasena),
            'telefono' => $request->telefono,
        ]);

        return redirect()->route('usuarios.index')->with('success', 'Usuario creado con éxito.');
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
    public function edit($id)
    {
        $usuario = Usuario::findOrFail($id); // Encuentra el usuario o devuelve un error 404
        return view('usuarios.edit', compact('usuario')); // Devuelve la vista con los datos del usuario
    }

    /**
     * Actualizar un usuario en la base de datos.
     */
    public function update(Request $request, $id)
    {
        // Validar los datos del formulario
        $request->validate([
            'nombre' => 'required|string|max:100',
            'correo' => 'required|string|email|max:100|unique:usuarios,correo,'.$id.',idUsuario',
            'telefono' => 'nullable|string|max:20',
            // No validamos la contraseña aquí a menos que el usuario desee cambiarla
        ]);

        // Buscar el usuario en la base de datos
        $usuario = Usuario::findOrFail($id);

        // Actualizar los datos del usuario
        $usuario->update([
            'nombre' => $request->nombre,
            'correo' => $request->correo,
            'telefono' => $request->telefono,
            // Solo actualizamos la contraseña si el usuario ingresa una nueva
            'contrasena' => $request->contrasena ? Hash::make($request->contrasena) : $usuario->contrasena,
        ]);

        return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado con éxito.');
    }

    /**
     * Eliminar un usuario específico.
     */
    public function destroy($id)
    {
        $usuario = Usuario::findOrFail($id); // Encuentra el usuario o devuelve un error 404
        $usuario->delete(); // Elimina el usuario

        return redirect()->route('usuarios.index')->with('success', 'Usuario eliminado con éxito.');
    }
}
