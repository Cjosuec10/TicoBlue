<?php

namespace App\Http\Controllers;

use App\Models\Comercio;
use Illuminate\Http\Request;

class ComercioController extends Controller
{
    public function index()
    {
        $comercios = Comercio::all(); // Obtener todos los comercios
      
        return view('Comercio.index', compact('comercios'));
    }
    
    
    public function create()
    {
        return view('Comercio.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombreComercio' => 'required|max:100',
            'tipoNegocio' => 'required|max:100',
            'correoComercio' => 'required|email|unique:comercios,correoComercio',
            'telefonoComercio' => 'nullable|max:20',
            'descripcionComercio' => 'nullable',
            'idUsuario_fk' => 'required|exists:usuarios,idUsuario',
        ]);

        Comercio::create($request->all());

        return redirect()->route('comercios.index')->with('success', 'Comercio creado exitosamente.');
    }

    public function show(Comercio $comercio)
    {
        return view('Comercio.show', compact('comercio'));
    }

    public function edit(Comercio $comercio)
    {
        return view('Comercio.edit', compact('comercio'));
    }

    public function update(Request $request, Comercio $comercio)
    {
        $request->validate([
            'nombreComercio' => 'required|max:100',
            'tipoNegocio' => 'required|max:100',
            'correoComercio' => 'required|email|unique:comercios,correoComercio,'.$comercio->idComercio.',idComercio',
            'telefonoComercio' => 'nullable|max:20',
            'descripcionComercio' => 'nullable',
            'idUsuario_fk' => 'required|exists:usuarios,idUsuario',
        ]);

        $comercio->update($request->all());

        return redirect()->route('comercios.index')->with('success', 'Comercio actualizado exitosamente.');
    }

    public function destroy(Comercio $comercio)
    {
        $comercio->delete();

        return redirect()->route('comercios.index')->with('success', 'Comercio eliminado exitosamente.');
    }
}
