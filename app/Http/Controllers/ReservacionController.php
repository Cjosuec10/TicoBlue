<?php

namespace App\Http\Controllers;

use App\Models\Reservacion;
use App\Models\Comercio;
use App\Models\Evento;
use App\Models\Usuario;
use App\Models\Alojamiento;
use Illuminate\Http\Request;

class ReservacionController extends Controller
{
    // Método para mostrar todas las reservaciones
    public function index()
    {
        $reservaciones = Reservacion::all();
        return view('reservaciones.index', compact('reservaciones'));
    }

    // Método para mostrar el formulario de creación de una nueva reservación
    public function create()
    {
        $comercios = Comercio::all();
        $eventos = Evento::all();
        $usuarios = Usuario::all();
        $alojamientos = Alojamiento::all();

        return view('reservaciones.create', compact('comercios', 'eventos', 'usuarios', 'alojamientos'));
    }

    // Método para almacenar una nueva reservación en la base de datos
    public function store(Request $request)
    {
        // Crear una nueva instancia de Reservacion
        $newReservacion = new Reservacion();

        // Asignar los datos del request a los atributos del modelo
        $newReservacion->fechaInicio = $request->fechaInicio;
        $newReservacion->fechaFin = $request->fechaFin;
        $newReservacion->nombreUsuarioReservacion = $request->nombreUsuarioReservacion;
        $newReservacion->correoUsuarioReservacion = $request->correoUsuarioReservacion;
        $newReservacion->telefonoUsuarioReservacion = $request->telefonoUsuarioReservacion;
        $newReservacion->idComercio_fk = $request->idComercio_fk;
        $newReservacion->idEvento_fk = $request->idEvento_fk;
        $newReservacion->idUsuario_fk = $request->idUsuario_fk;
        $newReservacion->idAlojamiento_fk = $request->idAlojamiento_fk;

        // Guardar la reservación en la base de datos
        $newReservacion->save();

        return redirect()->route('reservaciones.index')->with('success', 'Reservación creada exitosamente.');
    }

    // Método para mostrar los detalles de una reservación específica
    public function show($id)
    {
        $reservacion = Reservacion::findOrFail($id);
        return view('reservaciones.show', compact('reservacion'));
    }

    // public function edit($id)
    // {
    //     $reservacion = Reservacion::findOrFail($id); // Busca la reservación por su ID
    //     return view('reservaciones.edit', compact('reservacion')); // Carga la vista de edición
    // }
    // // Método para mostrar el formulario de edición de una reservación existente
    public function edit($id)
    {

        $reservacion = Reservacion::findOrFail($id);
        $comercios = Comercio::all();
        $eventos = Evento::all();
        $usuarios = Usuario::all();
        $alojamientos = Alojamiento::all();

        return view('reservaciones.edit', compact('reservacion', 'comercios', 'eventos', 'usuarios', 'alojamientos'));
    }

    // Método para actualizar una reservación existente en la base de datos

    public function update(Request $request, $id)
    {
        // Encuentra la reservación por su ID
        $reservacion = Reservacion::findOrFail($id);

        // Validar los campos del formulario
        $request->validate([
            'fechaInicio' => 'required|date',
            'fechaFin' => 'required|date',
            'nombreUsuarioReservacion' => 'required|string|max:255',
            'correoUsuarioReservacion' => 'required|email|max:255',
            'telefonoUsuarioReservacion' => 'nullable|string|max:20',
            'idComercio_fk' => 'required|exists:comercios,idComercio',
            'idEvento_fk' => 'nullable|exists:eventos,idEvento',
            'idUsuario_fk' => 'required|exists:usuarios,idUsuario',
            'idAlojamiento_fk' => 'nullable|exists:alojamientos,idAlojamiento',
        ]);

        // Actualiza la reservación con los datos del formulario
        $reservacion->update($request->all());

        // Redirige de vuelta al índice con un mensaje de éxito
        return redirect()->route('reservaciones.index')->with('success', 'Reservación actualizada exitosamente.');
    }



    public function destroy($id)
    {
        // Intentar cargar la reservación
        $reservacion = Reservacion::find($id);

        if (!$reservacion) {
            return redirect()->route('reservaciones.index')->with('error', 'Reservación no encontrada.');
        }

        // Verificar que el objeto se ha cargado correctamente
       // dd($reservacion); // Depuración: Aquí deberías ver los datos de la reservación

        // Eliminar la reservación
        $reservacion->delete();

        return redirect()->route('reservaciones.index')->with('success', 'Reservación eliminada exitosamente.');
    }


}
