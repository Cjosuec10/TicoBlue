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
    public function __construct()
    {
        $this->middleware('permission:ver-reservacion|crear-reservacion|editar-reservacion|borrar-reservacion', ['only' => ['index']]);
        $this->middleware('permission:crear-reservacion', ['only' => ['create', 'store']]);
        $this->middleware('permission:editar-reservacion', ['only' => ['edit', 'update']]);
        $this->middleware('permission:borrar-reservacion', ['only' => ['destroy']]);
    }

    public function index()
    {
        $reservaciones = Reservacion::with(['comercio', 'evento', 'alojamiento'])->get();
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

    public function store(Request $request)
{
    // Validar los datos de entrada
    $request->validate([
        'nombreUsuarioReservacion' => 'required|string|max:255',
        'correoUsuarioReservacion' => 'required|email|max:255',
        'telefonoUsuarioReservacion' => 'nullable|string|max:20',
        'idComercio_fk' => 'required|exists:comercios,idComercio',
        'idEvento_fk' => 'nullable|exists:eventos,idEvento', // Ahora es opcional
        'idUsuario_fk' => 'required|exists:usuarios,idUsuario',
        'idAlojamiento_fk' => 'nullable|exists:alojamientos,idAlojamiento',
    ]);

    // Crear la reservación
    $reservacion = Reservacion::create([
        'nombreUsuarioReservacion' => $request->nombreUsuarioReservacion,
        'correoUsuarioReservacion' => $request->correoUsuarioReservacion,
        'telefonoUsuarioReservacion' => $request->telefonoUsuarioReservacion,
        'idComercio_fk' => $request->idComercio_fk,
        'idEvento_fk' => $request->idEvento_fk ?? null, // Establecer como null si no se proporciona
        'idUsuario_fk' => $request->idUsuario_fk,
        'idAlojamiento_fk' => $request->idAlojamiento_fk ?? null, // Establecer como null si no se proporciona
    ]);

    return redirect()->route('reservaciones.index')->with('success', 'Reservación creada exitosamente.');
}
    

    // Método para mostrar los detalles de una reservación específica
    public function show(Reservacion $reservacion)
    {
        return view('reservaciones.show', compact('reservacion'));
    }

    // public function edit($id)
    // {
    //     $reservacion = Reservacion::findOrFail($id); // Busca la reservación por su ID
    //     return view('reservaciones.edit', compact('reservacion')); // Carga la vista de edición
    // }
    // // Método para mostrar el formulario de edición de una reservación existente
    public function edit(Reservacion $reservacion)
    {
        $comercios = Comercio::all();
        $eventos = Evento::all();
        $usuarios = Usuario::all();
        $alojamientos = Alojamiento::all();
    
        return view('reservaciones.edit', compact('reservacion', 'comercios', 'eventos', 'usuarios', 'alojamientos'));
    }

    // Método para actualizar una reservación existente en la base de datos

    public function update(Request $request, Reservacion $reservacion)
{
    // Validar los campos del formulario
    $request->validate([
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



public function destroy(Reservacion $reservacion)
{
    // Eliminar la reservación
    $reservacion->delete();

    return redirect()->route('reservaciones.index')->with('success', 'Reservación eliminada exitosamente.');
}


}