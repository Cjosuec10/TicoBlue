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
use App\Http\Controllers\NotificationController;

// Rutas públicas (accesibles sin autenticación)
Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/Productos', [ProductoController::class, 'mostrarInformacionProductos'])->name('productos');
Route::get('/Eventos', [EventoController::class, 'mostrarInformacionEventos'])->name('eventos');
Route::get('/Alojamientos', [AlojamientoController::class, 'mostrarInformacionAlojamientos'])->name('alojamientos');
Route::get('/Comercios', [ComercioController::class, 'mostrarInformacionComercios'])->name('comercios');
Route::view('/Contacto', 'frontend.contacto')->name('contacto');
Route::view('/Sobre-nosotros', 'frontend.sobre-nosotros')->name('sobre-nosotros');

// Rutas de activación/desactivación para comercio
Route::post('/comercios/{id}/toggle-activation', [ComercioController::class, 'toggleActivation'])->name('comercios.toggleActivation');

// Rutas de autenticación
Route::prefix('auth')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    
    Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register.form');
    Route::post('register', [RegisterController::class, 'register'])->name('register');
});

// Rutas de notificación
Route::prefix('notifications')->group(function () {
    Route::post('/store', [NotificationController::class, 'store'])->name('notifications.store');
    Route::get('/', [NotificationController::class, 'index'])->name('notifications.index');
    Route::patch('/{id}/read', [NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');
    Route::get('/all', [NotificationController::class, 'allNotifications'])->name('notifications.all');
});

// Rutas para activar/desactivar 
//product
Route::prefix('productos')->name('productos.')->group(function () {
    Route::post('{id}/activar', [ProductoController::class, 'activar'])->name('activar');
    Route::post('{id}/desactivar', [ProductoController::class, 'desactivar'])->name('desactivar');
    Route::post('{id}/toggle-activation', [ProductoController::class, 'toggleActivation'])->name('toggleActivation');
});
//alojamiento
Route::post('/alojamientos/{id}/toggle-activation', [AlojamientoController::class, 'toggleActivation'])->name('alojamientos.toggleActivation');



// Ruta para cambiar el idioma
Route::get('/set-language/{lang}', [LanguageController::class, 'setLanguage'])->name('set.language');

// Rutas protegidas por autenticación
Route::middleware('auth')->group(function () {
    Route::resource('comercios', ComercioController::class);
    Route::resource('productos', ProductoController::class);
    Route::resource('eventos', EventoController::class);
    Route::resource('reservaciones', ReservacionController::class);
    Route::resource('alojamiento', AlojamientoController::class);
    Route::resource('usuarios', UsuarioController::class);
    Route::resource('roles', RolController::class);

    // Vista del panel de administración
    Route::view('/admin', 'admin.admin')->name('admin');
});

//busquedas
Route::get('/buscar-alojamientos', [AlojamientoController::class, 'buscarAlojamientos'])->name('alojamientos.buscar');

