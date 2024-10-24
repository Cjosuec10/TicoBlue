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
        $alojamientos = Alojamiento::all();
        return view('alojamiento.index', compact('alojamientos'));
    }

    public function create()
    {
        $usuarios = Usuario::all();
        $comercios = Comercio::all();
        return view('alojamiento.create', compact('usuarios', 'comercios'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombreAlojamiento' => 'required|max:100',
            'descripcionAlojamiento' => 'nullable',
            'precioAlojamiento' => 'required|numeric',
            'capacidad' => 'required|integer',
            'idComercio_fk' => 'required|exists:comercios,idComercio',
            'idUsuario_fk' => 'required|exists:usuarios,idUsuario',
            'imagen' => 'nullable|image|max:2048',
            'fechaInicio' => 'required|date',
            'fechaFin' => 'required|date|after_or_equal:fechaInicio',
        ]);

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
        $alojamiento = Alojamiento::findOrFail($id);
        $usuarios = Usuario::all();
        $comercios = Comercio::all();
        return view('alojamiento.edit', compact('alojamiento', 'usuarios', 'comercios'));
    }


    public function update(Request $request, $id)
    {
        // Validar los datos
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
