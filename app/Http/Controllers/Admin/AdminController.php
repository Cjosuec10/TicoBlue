<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Comercio;
use App\Models\Evento;
use App\Models\Producto;
use App\Models\Alojamiento;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Obtener el usuario logueado
        $user = Auth::user();

        // Contar comercios creados por el usuario
        $totalComercios = Comercio::where('idUsuario_fk', $user->idUsuario)->count();

        // Contar eventos asociados a los comercios del usuario
        $comercioIds = Comercio::where('idUsuario_fk', $user->idUsuario)->pluck('idComercio');
        
        $totalEventos = Evento::whereIn('idComercio_fk', $comercioIds)->count();
        $totalProductos = Producto::whereIn('idComercio_fk', $comercioIds)->count();
        $totalAlojamientos = Alojamiento::whereIn('idComercio_fk', $comercioIds)->count();

        // Pasar los totales a la vista del dashboard
        return view('admin.dashboard', compact('totalComercios', 'totalEventos', 'totalProductos', 'totalAlojamientos'));
    }
    public function index()
    {
        // Obtener el usuario logueado
        $user = Auth::user();
    
        // Contar comercios creados por el usuario
        $totalComercios = Comercio::where('idUsuario_fk', $user->idUsuario)->count();
    
        // Contar eventos asociados a los comercios del usuario
        $comercioIds = Comercio::where('idUsuario_fk', $user->idUsuario)->pluck('idComercio');
    
        $totalEventos = Evento::whereIn('idComercio_fk', $comercioIds)->count();
        $totalProductos = Producto::whereIn('idComercio_fk', $comercioIds)->count();
        $totalAlojamientos = Alojamiento::whereIn('idComercio_fk', $comercioIds)->count();
    
        // Pasar los totales a la vista de administración
        return view('layout.administracion', compact('totalComercios', 'totalEventos', 'totalProductos', 'totalAlojamientos'));
    }
}

