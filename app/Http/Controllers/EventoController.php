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
         // Obtener los comercios del usuario autenticado
         $comercios = auth()->user()->comercios->pluck('idComercio');

         // Filtrar los eventos que pertenecen a esos comercios
         $eventos = Evento::whereIn('idComercio_fk', $comercios)->get();
 
         return view('eventos.index', compact('eventos'));
    }

    public function create()
    {
        // Obtener solo los comercios ligados al usuario autenticado
        $comercios = auth()->user()->comercios;
        
        return view('eventos.create', compact('comercios'));
    }

    public function store(Request $request)
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

        $newevento = new Evento($request->except('imagen'));

        if ($request->hasFile('imagen')) {
            $file = $request->file('imagen');
            $destinationPath = 'img/imagen/';
            $fileName = time() . '-' . $file->getClientOriginalName();
            $file->move($destinationPath, $fileName);
            $newevento->imagen = $destinationPath . $fileName;
        }

        $newevento->save();

        return redirect()->route('eventos.index')->with('success', 'Evento creado exitosamente.');
    }

    public function show(Evento $evento)
    {
        return view('eventos.show', compact('evento'));
    }

    public function edit(Evento $evento)
    {
        $comercios = auth()->user()->comercios;
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

        $evento->fill($request->except('imagen'));

        if ($request->hasFile('imagen')) {
            $file = $request->file('imagen');
            $destinationPath = 'img/imagen/';
            $fileName = time() . '-' . $file->getClientOriginalName();
            $file->move($destinationPath, $fileName);
            $evento->imagen = $destinationPath . $fileName;
        }

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
        // Cambia get() por paginate(8) para obtener paginación de 8 eventos por página
        $eventos = Evento::where('activo', true)->paginate(8);
        $comercios = Comercio::all();
        $alojamientos = Alojamiento::all();
        $usuarioLogueado = Auth::user();
    
        return view('frontend.eventos', compact('eventos', 'comercios', 'usuarioLogueado', 'alojamientos'));
    }
    
    public function toggleActivation(Request $request, $id)
{
    $evento = Evento::findOrFail($id);
    $activo = $request->input('activo');

    // Actualiza el estado de activación
    $evento->activo = $activo;
    $evento->save();

    return response()->json(['success' => true]);
}
public function buscar(Request $request)
{
    $query = $request->input('q');

    // Filtrar eventos activos que coincidan con el término de búsqueda
    $eventos = Evento::where('activo', true)
        ->where(function ($q) use ($query) {
            $q->where('nombreEvento', 'LIKE', "%{$query}%")
              ->orWhere('descripcionEvento', 'LIKE', "%{$query}%");
        })
        ->paginate(8);

    // Retornar eventos con paginación en la respuesta JSON
    return response()->json([
        'eventos' => $eventos->items(),
        'pagination' => (string) $eventos->links('pagination::bootstrap-4'),
    ]);
}


}
