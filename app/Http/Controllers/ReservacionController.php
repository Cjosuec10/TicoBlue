<?php

namespace App\Http\Controllers;

use App\Models\Reservacion;
use Illuminate\Http\Request;

class ReservacionController extends Controller
{
    public function index()
    {
        $reservaciones = Reservacion::all(); // Obtener todas las reservaciones
        return view('reservaciones.index', compact('reservaciones'));
    }

    public function create()
    {
        // Obtener todos los comercios, eventos, usuarios y alojamientos disponibles
        $comercios = \App\Models\Comercio::all();
        $eventos = \App\Models\Evento::all();
        $usuarios = \App\Models\Usuario::all();
        $alojamientos = \App\Models\Alojamiento::all();

        return view('reservaciones.create', compact('comercios', 'eventos', 'usuarios', 'alojamientos'));
    }

    public function store(Request $request)
    {
        // Validar los datos de la solicitud
        $request->validate([
            'fechaInicio' => 'required|date',
            'fechaFin' => 'required|date|after_or_equal:fechaInicio',
            'nombreUsuarioReservacion' => 'required|string|max:100',
            'correoUsuarioReservacion' => 'required|email',
            'telefonoUsuarioReservacion' => 'nullable|string|max:20',
            'idComercio_fk' => 'required|exists:comercios,idComercio',
            'idEvento_fk' => 'nullable|exists:eventos,idEvento',
            'idUsuario_fk' => 'nullable|exists:usuarios,idUsuario',
            'idAlojamiento_fk' => 'nullable|exists:alojamientos,idAlojamiento',
        ]);

        // Crear una nueva instancia de Reservacion y llenar los campos
        Reservacion::create($request->all());

        // Redirigir al índice con mensaje de éxito
        return redirect()->route('reservaciones.index')->with('success', 'Reservación creada exitosamente.');
    }



    public function show(Reservacion $reservacion)
    {
        return view('reservaciones.show', compact('reservacion'));
    }

    public function edit(Reservacion $reservacion)
    {
        // Obtener todos los comercios, eventos, usuarios y alojamientos disponibles
        $comercios = \App\Models\Comercio::all();
        $eventos = \App\Models\Evento::all();
        $usuarios = \App\Models\Usuario::all();
        $alojamientos = \App\Models\Alojamiento::all();

        return view('reservaciones.edit', compact('reservacion', 'comercios', 'eventos', 'usuarios', 'alojamientos'));
    }

    public function update(Request $request, Reservacion $reservacion)
    {
        // Validar los campos
        $request->validate([
            'nombreUsuarioReservacion' => 'required|max:255',
            'correoUsuarioReservacion' => 'required|email|max:255',
            'telefonoUsuarioReservacion' => 'nullable|max:20',
            'fechaInicio' => 'required|date',
            'fechaFin' => 'required|date',
            'idComercio_fk' => 'required|exists:comercios,idComercio',
            'idEvento_fk' => 'nullable|exists:eventos,idEvento',
            'idUsuario_fk' => 'nullable|exists:usuarios,idUsuario',
            'idAlojamiento_fk' => 'nullable|exists:alojamientos,idAlojamiento',
        ]);

        // Actualiza los campos de la reservación
        $reservacion->nombreUsuarioReservacion = $request->nombreUsuarioReservacion;
        $reservacion->correoUsuarioReservacion = $request->correoUsuarioReservacion;
        $reservacion->telefonoUsuarioReservacion = $request->telefonoUsuarioReservacion;
        $reservacion->fechaInicio = $request->fechaInicio;
        $reservacion->fechaFin = $request->fechaFin;

        // Actualizar claves foráneas, permitiendo valores nulos
        $reservacion->idComercio_fk = $request->idComercio_fk;
        $reservacion->idEvento_fk = $request->idEvento_fk;
        $reservacion->idUsuario_fk = $request->idUsuario_fk;
        $reservacion->idAlojamiento_fk = $request->idAlojamiento_fk;

        // Guardar los cambios
        $reservacion->save();

        return redirect()->route('reservaciones.index')->with('success', 'Reservación actualizada exitosamente.');
    }


    public function destroy(Reservacion $reservacion)
    {
        $reservacion->delete();

        return redirect()->route('reservaciones.index')->with('success', 'Reservación eliminada exitosamente.');
    }

}
