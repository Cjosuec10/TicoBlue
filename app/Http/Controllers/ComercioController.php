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
    // Obtener todos los usuarios disponibles
    $usuarios = \App\Models\Usuario::all();
    
    // Pasar los usuarios a la vista
    return view('Comercio.create', compact('usuarios'));
}


public function store(Request $request)
{
    // Validar los datos de la solicitud
    $request->validate([
        'nombreComercio' => 'required|max:100',
        'tipoNegocio' => 'required|max:100',
        'correoComercio' => 'required|email|unique:comercios,correoComercio',
        'telefonoComercio' => 'nullable|max:20',
        'descripcionComercio' => 'nullable',
        'idUsuario_fk' => 'required|exists:usuarios,idUsuario',
    ]);

    // Crear el comercio en la base de datos
    Comercio::create($request->all());

    // Redirigir a la lista de comercios con un mensaje de éxito
    return redirect()->route('comercios.index')->with('success', 'Comercio creado exitosamente.');
}



    public function show(Comercio $comercio)
    {
        return view('Comercio.show', compact('comercio'));
    }

    public function edit(Comercio $comercio)
    {
        // Obtener todos los usuarios disponibles
        $usuarios = \App\Models\Usuario::all();
        
        // Pasar los usuarios y el comercio a la vista
        return view('Comercio.edit', compact('comercio', 'usuarios'));
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
