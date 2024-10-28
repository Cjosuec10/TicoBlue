<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Usuario; // Asegúrate de que el modelo Usuario esté importado
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
        return view('auth.register'); // Asegúrate de que esta vista exista
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
        ]);

        // Crear el usuario
        $usuario = Usuario::create([
            'nombre' => $request->nombre,
            'correo' => $request->correo,
            'contrasena' => Hash::make($request->contrasena),
            'telefono' => $request->telefono,
        ]);

        // Autenticar al usuario automáticamente después del registro
        Auth::login($usuario);

        return view('welcome')->with('success', 'Registro exitoso y usuario autenticado.');

        // return redirect()->route('admin')->with('success', 'Registro exitoso y usuario autenticado.');
    }
}
