<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ComercioController;
use App\Http\Controllers\EventoController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\AlojamientoController;
use App\Http\Controllers\UsuarioController;

// Rutas de autenticación
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// Rutas de registro
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register.form');
Route::post('register', [RegisterController::class, 'register'])->name('register');

// Rutas protegidas por autenticación
Route::group(['middleware' => 'auth'], function () {
    Route::resource('comercios', ComercioController::class);
    Route::resource('productos', ProductoController::class);
    Route::resource('eventos', EventoController::class);
    Route::resource('alojamiento', AlojamientoController::class);
    Route::resource('usuarios', UsuarioController::class);
    Route::get('/set-language/{lang}', function ($lang) {
        // Guarda el idioma en la sesión
        session(['locale' => $lang]);
    
        // Redirige de vuelta a la página anterior
        return redirect()->back();
    })->name('set.language');

    Route::get('/admin', function () {
        return view('admin.admin');
    })->name('admin'); 
});

// Ruta principal
Route::get('/', function () {
    return view('welcome');
});