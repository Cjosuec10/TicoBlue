<?php

namespace App\Http\Controllers;

use App\Models\Comercio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ComercioController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:ver-comercio|crear-comercio|editar-comercio|borrar-comercio', ['only' => ['index']]);
        $this->middleware('permission:crear-comercio', ['only' => ['create', 'store']]);
        $this->middleware('permission:editar-comercio', ['only' => ['edit', 'update']]);
        $this->middleware('permission:borrar-comercio', ['only' => ['destroy']]);
    }
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
            'imagen' => 'nullable|image|max:2048',
            'direccion_url' => 'required|string|max:500',
            'direccion_texto' => 'nullable|string|max:255',
            'idUsuario_fk' => 'required|exists:usuarios,idUsuario',
        ], [
            'direccion_url.max' => 'Asegúrese de que el ID del Mapa de Google tenga menos de 500 caracteres.',
        ]);

        // Crear una nueva instancia de Comercio
        $newcomercio = new Comercio($request->all());

        // Manejo de subida de imagen
        if ($request->hasFile('imagen')) {
            $file = $request->file('imagen');
            $destinationPath = 'img/imagen/';
            $fileName = time() . '-' . $file->getClientOriginalName();
            $file->move($destinationPath, $fileName);
            $newcomercio->imagen = $destinationPath . $fileName;
        }

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
            'direccion_url' => 'required|string|max:500', // Validar que sea una URL válida
            'direccion_texto' => 'nullable|string|max:255', // Validar que sea una cadena de texto
            'idUsuario_fk' => 'required|exists:usuarios,idUsuario',

            'direccion_url.max' => 'Asegúrese de que su ID tenga menos de 500 caracteres y sea valido.',
        ]);
        // Actualizar los datos del comercio, incluyendo direccion_url
        $comercio->nombreComercio = $request->nombreComercio;
        $comercio->tipoNegocio = $request->tipoNegocio;
        $comercio->correoComercio = $request->correoComercio;
        $comercio->telefonoComercio = $request->telefonoComercio;
        $comercio->descripcionComercio = $request->descripcionComercio;
        $comercio->direccion_url = $request->direccion_url;
        $comercio->direccion_texto = $request->direccion_texto;
        $comercio->idUsuario_fk = $request->idUsuario_fk;


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

    // Guardar los cambios en la base de datos
    $comercio->save();
        // Redirigir a la lista de comercios con un mensaje de éxito
        return redirect()->route('comercios.index')->with('success', 'Comercio actualizado exitosamente.');
    }

    public function mostrarInformacionComercios()
{
    // Obtener todos los comercios
    $comercios = Comercio::all();

    // Pasar los comercios a la vista
    return view('frontend.comercios', compact('comercios'));
}

    // Eliminar un comercio
    public function destroy(Comercio $comercio)
    {
        $comercio->delete();
        return redirect()->route('comercios.index')->with('success', 'Comercio eliminado exitosamente.');
    }


}
