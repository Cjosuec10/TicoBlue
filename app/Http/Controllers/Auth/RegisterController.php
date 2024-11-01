<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Usuario; // Asegúrate de que el modelo Usuario esté importado
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;



class RegisterController extends Controller
{
    /**
     * Mostrar el formulario de registro.
     */
    public function showRegistrationForm()
    {
        $roles = Role::where('id', '!=', 1)->get();
        return view('auth.register', compact('roles')); // Pasa los roles a la vista
    }

    /**
     * Procesar el registro.
     */
    public function register(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'nombre' => 'required|string|max:100',
            'correo' => 'required|string|email|max:100|unique:usuarios,correo',
            'contrasena' => 'required|string|min:8|confirmed',
            'telefono' => 'nullable|string|max:20',
            'rol' => 'required|exists:roles,id',

        ]);

        // Crear el usuario
        $usuario = Usuario::create([
            'nombre' => $request->nombre,
            'correo' => $request->correo,
            'contrasena' => Hash::make($request->contrasena),
            'telefono' => $request->telefono,
        ]);
        // Asignar rol
     // Obtener el rol por ID y asignar el nombre del rol
    $role = Role::findById($request->input('rol'));
    $usuario->assignRole($role->name);

        // Autenticar al usuario automáticamente después del registro
        Auth::login($usuario);

        return view('welcome')->with('success', 'Registro exitoso y usuario autenticado.');

        // return redirect()->route('admin')->with('success', 'Registro exitoso y usuario autenticado.');
    }
}
