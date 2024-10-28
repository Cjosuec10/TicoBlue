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

    public function store(Request $request)
    {
        // Validar los datos de entrada
        $request->validate([
            'nombreUsuarioReservacion' => 'required|string|max:255',
            'correoUsuarioReservacion' => 'required|email|max:255',
            'telefonoUsuarioReservacion' => 'nullable|string|max:20',
            'idComercio_fk' => 'required|exists:comercios,idComercio',
            'idEvento_fk' => 'nullable|exists:eventos,idEvento', // Hacerlo opcional
            'idUsuario_fk' => 'required|exists:usuarios,idUsuario',
            'idAlojamiento_fk' => 'nullable|exists:alojamiento,idAlojamiento', // Hacerlo opcional
        ]);
    
        // Establecer `idEvento_fk` como `null` si no se proporciona
        $idEventoFk = $request->idEvento_fk ?? null;
        $idAlojamientoFk = $request->idAlojamiento_fk ?? null;
    
        // Crear una nueva instancia de Reservacion
        $newReservacion = new Reservacion();
        $newReservacion->nombreUsuarioReservacion = $request->nombreUsuarioReservacion;
        $newReservacion->correoUsuarioReservacion = $request->correoUsuarioReservacion;
        $newReservacion->telefonoUsuarioReservacion = $request->telefonoUsuarioReservacion;
        $newReservacion->idComercio_fk = $request->idComercio_fk;
        $newReservacion->idEvento_fk = $idEventoFk; // Asignar como null si no está presente
        $newReservacion->idUsuario_fk = $request->idUsuario_fk;
        $newReservacion->idAlojamiento_fk = $idAlojamientoFk; // Asignar como null si no está presente
    
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
            'nombreUsuarioReservacion' => 'required|string|max:255',
            'correoUsuarioReservacion' => 'required|email|max:255',
            'telefonoUsuarioReservacion' => 'nullable|string|max:20',
            'idComercio_fk' => 'required|exists:comercios,idComercio',
            'idEvento_fk' => 'nullable|exists:eventos,idEvento',
            'idUsuario_fk' => 'required|exists:usuarios,idUsuario',
            'idAlojamiento_fk' => 'nullable|exists:alojamiento,idAlojamiento',
        ]);
    
        // Asignar valores de los campos
        $reservacion->nombreUsuarioReservacion = $request->nombreUsuarioReservacion;
        $reservacion->correoUsuarioReservacion = $request->correoUsuarioReservacion;
        $reservacion->telefonoUsuarioReservacion = $request->telefonoUsuarioReservacion;
        $reservacion->idComercio_fk = $request->idComercio_fk;
        $reservacion->idUsuario_fk = $request->idUsuario_fk;
        $reservacion->idEvento_fk = $request->idEvento_fk ?? null;
        $reservacion->idAlojamiento_fk = $request->idAlojamiento_fk ?? null;
    
        // Guardar los cambios en la base de datos
        $reservacion->save();
    
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

        $reservacion->delete();

        return redirect()->route('reservaciones.index')->with('success', 'Reservación eliminada exitosamente.');
    }


}