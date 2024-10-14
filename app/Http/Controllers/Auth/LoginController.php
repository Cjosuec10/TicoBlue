<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Usuario;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login'); // Vista de inicio de sesión
    }

    public function login(Request $request)
    {
        // Validar las credenciales de inicio de sesión
        $credentials = $request->validate([
            'correo' => ['required', 'email'],
            'contrasena' => ['required'],
        ]);
    
        // Obtener el usuario por correo
        $usuario = Usuario::where('correo', $request->correo)->first();
    
        // Verificar si existe y si la contraseña es correcta
        if ($usuario && Hash::check($request->contrasena, $usuario->contrasena)) {
            // Autenticar al usuario manualmente
            Auth::login($usuario, $request->remember);
    
            // Regenerar la sesión y redirigir
            $request->session()->regenerate();
            return redirect()->intended('/')->with('success', 'Inicio de sesión exitoso.');
        }
    
        // Si la autenticación falla
        return back()->withErrors([
            'correo' => 'Estas credenciales no coinciden con nuestros registros.',
        ])->onlyInput('correo');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}

