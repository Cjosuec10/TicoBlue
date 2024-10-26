<?php

namespace App\Http\Controllers;

use App\Models\Alojamiento;
use App\Models\Usuario;
use App\Models\Comercio;
use App\Models\Evento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AlojamientoController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:ver-alojamiento|crear-alojamiento|editar-alojamiento|borrar-alojamiento', ['only' => ['index']]);
        $this->middleware('permission:crear-alojamiento', ['only' => ['create', 'store']]);
        $this->middleware('permission:editar-alojamiento', ['only' => ['edit', 'update']]);
        $this->middleware('permission:borrar-alojamiento', ['only' => ['destroy']]);
    }

    public function index()
    {
        // Obtener los comercios del usuario autenticado
        $comercios = auth()->user()->comercios->pluck('idComercio');

        // Filtrar los alojamientos que pertenecen a esos comercios
        $alojamientos = Alojamiento::whereIn('idComercio_fk', $comercios)->get();
        return view('alojamiento.index', compact('alojamientos'));
    }

    public function create()
    {
        $comercios = auth()->user()->comercios;
        return view('alojamiento.create', compact('comercios'));
    
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombreAlojamiento' => 'required|max:100',
            'descripcionAlojamiento' => 'nullable',
            'precioAlojamiento' => 'required|numeric',
            'capacidad' => 'required|integer',
            'idComercio_fk' => 'required|exists:comercios,idComercio',
            'imagen' => 'nullable|image|max:2048',
            'fechaInicio' => 'required|date',
            'fechaFin' => 'required|date|after_or_equal:fechaInicio',
        ]);

        // Forzar el ID del usuario autenticado
        $validatedData['idUsuario_fk'] = auth()->id();

        // Manejo de la imagen si se carga
        if ($request->hasFile('imagen')) {
            $file = $request->file('imagen');
            $destinationPath = 'img/alojamientos/';
            $fileName = time() . '-' . $file->getClientOriginalName();
            $file->move($destinationPath, $fileName);
            $validatedData['imagen'] = $destinationPath . $fileName;
        }

        Alojamiento::create($validatedData);

        return redirect()->route('alojamiento.index')->with('success', 'Alojamiento creado con éxito.');
    }

    public function show($id)
    {
        $alojamiento = Alojamiento::findOrFail($id);
        return view('alojamiento.show', compact('alojamiento'));
    }

    public function edit($id)
    {
        // Buscar el alojamiento por su ID
        $alojamiento = Alojamiento::findOrFail($id);

        // Retornar la vista del show con el alojamiento encontrado
        return view('alojamiento.show', compact('alojamiento'));
    }


    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nombreAlojamiento' => 'required|max:100',
            'descripcionAlojamiento' => 'nullable',
            'precioAlojamiento' => 'required|numeric',
            'capacidad' => 'required|integer',
            'idComercio_fk' => 'required|exists:comercios,idComercio',
            'imagen' => 'nullable|image|max:2048',
            'fechaInicio' => 'required|date',
            'fechaFin' => 'required|date|after_or_equal:fechaInicio',
        ]);
    
        // Buscar el alojamiento por su ID
        $alojamiento = Alojamiento::findOrFail($id);
    
        // Forzar el ID del usuario autenticado
        $validatedData['idUsuario_fk'] = auth()->id();
    
        // Manejo de la imagen si se carga una nueva
        if ($request->hasFile('imagen')) {
            $file = $request->file('imagen');
            $destinationPath = 'img/alojamientos/';
            $fileName = time() . '-' . $file->getClientOriginalName();
            $file->move($destinationPath, $fileName);
            $validatedData['imagen'] = $destinationPath . $fileName;
        }
    
        $alojamiento->update($validatedData);
    
        return redirect()->route('alojamiento.index')->with('success', 'Alojamiento actualizado con éxito.');
    }


    public function destroy($id)
    {
        $alojamiento = Alojamiento::findOrFail($id);
        $alojamiento->delete();

        return redirect()->route('alojamiento.index')->with('success', 'Alojamiento eliminado con éxito.');
    }

    public function mostrarAlojamientos()
{
    $alojamientos = Alojamiento::with('comercio')->get(); // Cargar la relación comercio
    $comercios = Comercio::all(); // Asegurarse de obtener todos los comercios
    $usuarioLogueado = Auth::user(); // Obtener el usuario actualmente autenticado

    return view('frontend.alojamientos', compact('alojamientos', 'comercios', 'usuarioLogueado'));
}

}
