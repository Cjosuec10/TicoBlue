<?php

namespace App\Http\Controllers;

use App\Models\Alojamiento;
use App\Models\Usuario;  // Asegúrate de importar el modelo Usuario
use Illuminate\Http\Request;

class AlojamientoController extends Controller
{
    public function index()
    {
        $alojamientos = Alojamiento::all();
        return view('alojamiento.index', compact('alojamientos'));
    }

    public function create()
    {
        // Recupera la lista de usuarios y pásala a la vista
        $usuarios = Usuario::all();
        return view('alojamiento.create', compact('usuarios'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombreAlojamiento' => 'required|max:100',
            'precioAlojamiento' => 'required|numeric',
            'capacidad' => 'required|integer',
            'idComercio_fk' => 'required|exists:comercios,idComercio',
        ]);

        Alojamiento::create($request->all());
        return redirect()->route('alojamiento.index')->with('success', 'Alojamiento creado con éxito.');
    }

    public function edit(Alojamiento $alojamiento)
    {
        // Recupera la lista de usuarios para el campo de selección y pasa el alojamiento
        $usuarios = Usuario::all();
        return view('alojamiento.edit', compact('alojamiento', 'usuarios'));
    }

    public function update(Request $request, Alojamiento $alojamiento)
    {
        $request->validate([
            'nombreAlojamiento' => 'required|max:100',
            'precioAlojamiento' => 'required|numeric',
            'capacidad' => 'required|integer',
            'idComercio_fk' => 'required|exists:comercios,idComercio',
        ]);

        $alojamiento->update($request->all());
        return redirect()->route('alojamiento.index')->with('success', 'Alojamiento actualizado con éxito.');
    }

    public function destroy(Alojamiento $alojamiento)
    {
        $alojamiento->delete();
        return redirect()->route('alojamiento.index')->with('success', 'Alojamiento eliminado con éxito.');
    }
}
