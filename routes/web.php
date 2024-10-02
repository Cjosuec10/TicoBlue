<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ComercioController;
use App\Http\Controllers\EventoController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\AlojamientoController;

// Rutas para Comercios, Productos, Eventos y Alojamientos
Route::resource('comercios', ComercioController::class);
Route::resource('productos', ProductoController::class);
Route::resource('eventos', EventoController::class);
Route::resource('alojamiento', AlojamientoController::class);

Route::get('/', function () {
    return view('welcome');
});