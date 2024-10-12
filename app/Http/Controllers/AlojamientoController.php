<?php

namespace App\Http\Controllers;

use App\Models\Alojamiento;
use App\Models\Usuario; // Asegúrate de que este modelo también esté importado
use App\Models\Comercio; // Importa el modelo Comercio
use Illuminate\Http\Request;

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
    $usuarios = Usuario::all(); // Obtiene todos los usuarios
    $comercios = Comercio::all(); // Obtiene todos los comercios
    return view('alojamiento.create', compact('usuarios', 'comercios'));
}

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombreAlojamiento' => 'required|max:100',
            'descripcionAlojamiento' => 'nullable',
            'precioAlojamiento' => 'required|numeric',
            'capacidad' => 'required|integer',
            'idComercio_fk' => 'required|exists:comercios,idComercio', // Asegúrate de que este campo esté presente
            'idUsuario_fk' => 'required|exists:usuarios,idUsuario', // Asegúrate de que este campo también esté presente
        ]);

        Alojamiento::create($validatedData);

        return redirect()->route('alojamiento.index')->with('success', 'Alojamiento creado con éxito.');
    }

    // Mostrar un alojamiento en particular
    public function show($id)
    {
        $alojamiento = Alojamiento::findOrFail($id);
        return view('alojamiento.show', compact('alojamiento')); // Cambié 'alojamientos.show' por 'alojamiento.show'
    }

    // Mostrar el formulario para editar un alojamiento
    public function edit($id)
    {
        $alojamiento = Alojamiento::findOrFail($id);
        $usuarios = Usuario::all(); // Asegúrate de obtener usuarios para la vista de edición
        return view('alojamiento.edit', compact('alojamiento', 'usuarios')); // Cambié 'alojamientos.edit' por 'alojamiento.edit'
    }

    // Actualizar un alojamiento existente
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nombreAlojamiento' => 'required|max:100',
            'descripcionAlojamiento' => 'nullable',
            'precioAlojamiento' => 'required|numeric',
            'capacidad' => 'required|integer',
            'idComercio_fk' => 'required|exists:comercios,idComercio'
        ]);

        $alojamiento = Alojamiento::findOrFail($id);
        $alojamiento->update($validatedData);

        return redirect()->route('alojamiento.index')->with('success', 'Alojamiento actualizado con éxito.'); // Cambié 'alojamientos.index' por 'alojamiento.index'
    }

    // Eliminar un alojamiento
    public function destroy($id)
    {
        $alojamiento = Alojamiento::findOrFail($id);
        $alojamiento->delete();

        return redirect()->route('alojamiento.index')->with('success', 'Alojamiento eliminado con éxito.'); // Cambié 'alojamientos.index' por 'alojamiento.index'
    }
}
