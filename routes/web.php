<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ComercioController;
use App\Http\Controllers\EventoController;
use App\Http\Controllers\ReservacionController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\AlojamientoController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\LanguageController;

// Rutas públicas (accesibles sin autenticación)
Route::view('/Alojamientos', 'frontend.alojamientos')->name('alojamientos');
Route::view('/Comercios', 'frontend.comercios')->name('comercios');
Route::view('/Contacto', 'frontend.contacto')->name('contacto');
Route::view('/Eventos', 'frontend.eventos')->name('eventos');
Route::view('/Productos', 'frontend.productos')->name('productos');
Route::view('/Sobre-nosotros', 'frontend.sobre-nosotros')->name('sobre-nosotros');

// Rutas de autenticación
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// Rutas de registro
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register.form');
Route::post('register', [RegisterController::class, 'register'])->name('register');

// Rutas protegidas por autenticación
Route::middleware('auth')->group(function () {
    // Recursos CRUD protegidos
    Route::resource('comercios', ComercioController::class);
    Route::resource('productos', ProductoController::class);
    Route::resource('eventos', EventoController::class);
    Route::resource('reservaciones', ReservacionController::class);
    Route::resource('alojamiento', AlojamientoController::class);
    Route::resource('usuarios', UsuarioController::class);
    Route::resource('roles', RolController::class);


    Route::put('/alojamientos/{alojamiento}', [AlojamientoController::class, 'update'])->name('alojamientos.update');
    Route::get('/alojamientos', [AlojamientoController::class, 'index'])->name('alojamientos.index');

    // Eliminar una reservación
    Route::delete('/reservaciones/{reservacion}', [ReservacionController::class, 'destroy'])->name('reservaciones.destroy');

    // Ruta para cambiar el idioma
    Route::get('/set-language/{lang}', function ($lang) {
        session(['locale' => $lang]); // Guarda el idioma en la sesión
        return redirect()->back(); // Redirige de vuelta a la página anterior
    })->name('set.language');

    // Vista del panel de administración
    Route::view('/admin', 'admin.admin')->name('admin');
});

// Ruta principal (home)
Route::get('/', function () {
    return view('welcome');
});// Ruta principal (home)

