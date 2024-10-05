<?php

namespace App\Http\Controllers;

use App\Models\Comercio;
use Illuminate\Http\Request;

class ComercioController extends Controller
{
    // Mostrar todos los comercios
    public function index()
    {
        $comercios = Comercio::all(); // Obtener todos los comercios
        return view('Comercio.index', compact('comercios'));
    }

    // Mostrar el formulario de creación de un nuevo comercio
    public function create()
    {
        $usuarios = \App\Models\Usuario::all(); // Obtener todos los usuarios
        return view('Comercio.create', compact('usuarios'));
    }

    // Guardar un nuevo comercio
    public function store(Request $request)
    {
        // Validar los datos de la solicitud
        $request->validate([
            'nombreComercio' => 'required|max:100',
            'tipoNegocio' => 'required|max:100',
            'correoComercio' => 'required|email|unique:comercios,correoComercio',
            'telefonoComercio' => 'nullable|max:20',
            'descripcionComercio' => 'nullable',
            'imagen' => 'nullable|image|max:2048', // Validar que sea una imagen y el tamaño máximo
            'direccion_url' => 'nullable|url|max:255', // Validar que sea una URL válida
            'direccion_texto' => 'nullable|string|max:255', // Validar que sea una cadena de texto
            'idUsuario_fk' => 'required|exists:usuarios,idUsuario',
        ]);

        // Crear una nueva instancia de Comercio
        $newcomercio = new Comercio();

        // Manejo de subida de imagen
        if ($request->hasFile('imagen')) {
            $file = $request->file('imagen');
            $destinationPath = 'img/imagen/';
            $fileName = time() . '-' . $file->getClientOriginalName();
            $file->move($destinationPath, $fileName); // Subir el archivo
            $newcomercio->imagen = $destinationPath . $fileName; // Guardar la ruta
        }

        // Asignar los demás datos del formulario
        $newcomercio->nombreComercio = $request->nombreComercio;
        $newcomercio->tipoNegocio = $request->tipoNegocio;
        $newcomercio->correoComercio = $request->correoComercio;
        $newcomercio->telefonoComercio = $request->telefonoComercio;
        $newcomercio->descripcionComercio = $request->descripcionComercio;
        $newcomercio->direccion_url = $request->direccion_url;
        $newcomercio->direccion_texto = $request->direccion_texto;
        $newcomercio->idUsuario_fk = $request->idUsuario_fk;

        // Guardar el nuevo comercio en la base de datos
        $newcomercio->save();

        // Redirigir a la lista de comercios con un mensaje de éxito
        return redirect()->route('comercios.index')->with('success', 'Comercio creado exitosamente.');
    }

    // Mostrar los detalles de un comercio
    public function show(Comercio $comercio)
    {
        return view('Comercio.show', compact('comercio'));
    }

    // Mostrar el formulario de edición de un comercio
    public function edit(Comercio $comercio)
    {
        $usuarios = \App\Models\Usuario::all(); // Obtener todos los usuarios disponibles
        return view('Comercio.edit', compact('comercio', 'usuarios'));
    }

    // Actualizar los datos de un comercio existente
    public function update(Request $request, Comercio $comercio)
    {
        // Validar los datos de la solicitud
        $request->validate([
            'nombreComercio' => 'required|max:100',
            'tipoNegocio' => 'required|max:100',
            'correoComercio' => 'required|email|unique:comercios,correoComercio,' . $comercio->idComercio . ',idComercio',
            'telefonoComercio' => 'nullable|max:20',
            'descripcionComercio' => 'nullable',
            'imagen' => 'nullable|image|max:2048', // Validar que sea una imagen
            'direccion_url' => 'nullable|url|max:255', // Validar que sea una URL válida
            'direccion_texto' => 'nullable|string|max:255', // Validar que sea una cadena de texto
            'idUsuario_fk' => 'required|exists:usuarios,idUsuario',
        ]);

        // Manejo de subida de imagen
        if ($request->hasFile('imagen')) {
            $file = $request->file('imagen');
            $destinationPath = 'img/imagen/';
            $fileName = time() . '-' . $file->getClientOriginalName();
            $file->move($destinationPath, $fileName);
            $comercio->imagen = $destinationPath . $fileName;
        }

        // Actualizar los demás datos del comercio
        $comercio->update($request->except('imagen'));

        // Redirigir a la lista de comercios con un mensaje de éxito
        return redirect()->route('comercios.index')->with('success', 'Comercio actualizado exitosamente.');
    }

    // Eliminar un comercio
    public function destroy(Comercio $comercio)
    {
        $comercio->delete();
        return redirect()->route('comercios.index')->with('success', 'Comercio eliminado exitosamente.');
    }
}
