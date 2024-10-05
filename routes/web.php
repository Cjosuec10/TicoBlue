<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ComercioController;
use App\Http\Controllers\EventoController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\AlojamientoController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\LanguageController;

// Ruta principal
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/set-language/{language}', [LanguageController::class, 'setLanguage'])->name('set.language');

// Rutas de autenticación
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Rutas de registro
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register.form');
Route::post('/register', [RegisterController::class, 'register'])->name('register');

// Rutas protegidas por autenticación
Route::group(['middleware' => 'auth'], function () {
    // Rutas para administrar roles (necesitan permisos adecuados)
    Route::resource('roles', RolController::class);

    // Rutas para recursos protegidos
    Route::resource('comercios', ComercioController::class);
    Route::resource('productos', ProductoController::class);
    Route::resource('eventos', EventoController::class);
    Route::resource('alojamiento', AlojamientoController::class);
    Route::resource('usuarios', UsuarioController::class);
    
    // Página de administración
    Route::get('/admin', function () {
        return view('admin.admin');
    })->name('admin');
});
