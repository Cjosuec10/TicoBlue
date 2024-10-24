<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use App\Models\Comercio;
use App\Models\Usuario;
use App\Models\Alojamiento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventoController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:ver-evento|crear-evento|editar-evento|borrar-evento', ['only' => ['index']]);
        $this->middleware('permission:crear-evento', ['only' => ['create', 'store']]);
        $this->middleware('permission:editar-evento', ['only' => ['edit', 'update']]);
        $this->middleware('permission:borrar-evento', ['only' => ['destroy']]);
    }

    public function index()
    {
        $eventos = Evento::all();
        return view('eventos.index', compact('eventos'));
    }

    public function create()
    {
        $comercios = Comercio::all();
        return view('eventos.create', compact('comercios'));
    }

    public function store(Request $request)
    {
        // Validar los datos de la solicitud
        $request->validate([
            'nombreEvento' => 'required|max:100',
            'descripcionEvento' => 'nullable',
            'tipoEvento' => 'required|max:100',
            'correoEvento' => 'required|email',
            'telefonoEvento' => 'nullable|max:20',
            'direccionEvento' => 'nullable',
            'imagen' => 'nullable|image|max:2048',
            'fechaInicio' => 'required|date',
            'fechaFin' => 'required|date|after_or_equal:fechaInicio',
            'idComercio_fk' => 'required|exists:comercios,idComercio',
        ]);

        $newevento = new Evento();

        if ($request->hasFile('imagen')) {
            $file = $request->file('imagen');
            $destinationPath = 'img/imagen/';
            $fileName = time() . '-' . $file->getClientOriginalName();
            $file->move($destinationPath, $fileName);
            $newevento->imagen = $destinationPath . $fileName;
        }

        // Asignar los valores del formulario
        $newevento->nombreEvento = $request->nombreEvento;
        $newevento->descripcionEvento = $request->descripcionEvento;
        $newevento->tipoEvento = $request->tipoEvento;
        $newevento->telefonoEvento = $request->telefonoEvento;
        $newevento->correoEvento = $request->correoEvento;
        $newevento->direccionEvento = $request->direccionEvento;
        $newevento->fechaInicio = $request->fechaInicio;
        $newevento->fechaFin = $request->fechaFin;
        $newevento->idComercio_fk = $request->idComercio_fk;

        $newevento->save();

        return redirect()->route('eventos.index')->with('success', 'Evento creado exitosamente.');
    }

    public function show(Evento $evento)
    {
        return view('eventos.show', compact('evento'));
    }

    public function edit(Evento $evento)
    {
        $comercios = Comercio::all();
        return view('eventos.edit', compact('evento', 'comercios'));
    }

    public function update(Request $request, Evento $evento)
    {
        $request->validate([
            'nombreEvento' => 'required|max:100',
            'descripcionEvento' => 'nullable',
            'tipoEvento' => 'required|max:100',
            'correoEvento' => 'required|email',
            'telefonoEvento' => 'nullable|max:20',
            'direccionEvento' => 'nullable',
            'imagen' => 'nullable|image|max:2048',
            'fechaInicio' => 'required|date',
            'fechaFin' => 'required|date|after_or_equal:fechaInicio',
            'idComercio_fk' => 'required|exists:comercios,idComercio',
        ]);

        if ($request->hasFile('imagen')) {
            $file = $request->file('imagen');
            $destinationPath = 'img/imagen/';
            $fileName = time() . '-' . $file->getClientOriginalName();
            $file->move($destinationPath, $fileName);
            $evento->imagen = $destinationPath . $fileName;
        }

        $evento->nombreEvento = $request->nombreEvento;
        $evento->descripcionEvento = $request->descripcionEvento;
        $evento->tipoEvento = $request->tipoEvento;
        $evento->telefonoEvento = $request->telefonoEvento;
        $evento->correoEvento = $request->correoEvento;
        $evento->direccionEvento = $request->direccionEvento;
        $evento->fechaInicio = $request->fechaInicio;
        $evento->fechaFin = $request->fechaFin;
        $evento->idComercio_fk = $request->idComercio_fk;

        $evento->save();

        return redirect()->route('eventos.index')->with('success', 'Evento actualizado exitosamente.');
    }

    public function destroy(Evento $evento)
    {
        $evento->delete();
        return redirect()->route('eventos.index')->with('success', 'Evento eliminado exitosamente.');
    }

    public function mostrarInformacionEventos()
    {
        $eventos = Evento::all();
        $comercios = Comercio::all();
        $alojamientos = Alojamiento::all();
        $usuarioLogueado = Auth::user();

        return view('frontend.eventos', compact('eventos', 'comercios', 'usuarioLogueado', 'alojamientos'));
    }

}
