<?php

namespace App\Http\Controllers;

use App\Models\Comercio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class ComercioController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:ver-comercio|crear-comercio|editar-comercio|borrar-comercio', ['only' => ['index']]);
        $this->middleware('permission:crear-comercio', ['only' => ['create', 'store']]);
        $this->middleware('permission:editar-comercio', ['only' => ['edit', 'update']]);
        $this->middleware('permission:borrar-comercio', ['only' => ['destroy']]);
    }

    // Mostrar todos los comercios pertenecientes al usuario autenticado
    public function index()
    {
        $comercios = Comercio::where('idUsuario_fk', Auth::id())->get(); // Filtrar por el ID del usuario autenticado
        return view('Comercio.index', compact('comercios'));
    }

    // Mostrar el formulario para crear un nuevo comercio
    public function create()
    {
        $usuario = Auth::user(); // Obtener el usuario autenticado
        return view('Comercio.create', compact('usuario'));
    }

    // Guardar un nuevo comercio vinculado al usuario autenticado
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'nombreComercio' => 'required|max:100',
            'tipoNegocio' => 'required|max:100',
            'correoComercio' => 'required|email|unique:comercios,correoComercio',
            'telefonoComercio' => 'nullable|regex:/^\+\d{3} \d{4}-\d{4}$/', // Asegurar el formato
            'pais' => 'required', // Asegúrate de tener este campo en el formulario
            'descripcionComercio' => 'nullable',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'direccion_url' => 'nullable|string|max:500',
            'direccion_texto' => 'nullable|string|max:255',
        ], [
            'direccion_url.max' => 'Asegúrese de que el ID del Mapa de Google tenga menos de 500 caracteres.',
        ]);
    
        // Resto de la lógica para almacenar el comercio...
    }
    // Mostrar detalles de un comercio solo si pertenece al usuario autenticado
    public function show(Comercio $comercio)
    {
        // Verificar si el usuario autenticado es el dueño del comercio
        if ($comercio->idUsuario_fk !== auth()->id()) {
            abort(403, 'No tienes permiso para acceder a este comercio.');
        }

        return view('Comercio.show', compact('comercio'));
    }

    public function edit(Comercio $comercio)
{
    // Verificar si el usuario autenticado es el propietario del comercio
    $comercio->idUsuario_fk !== auth()->id();
    $usuario = auth()->user(); // Obtener solo el usuario autenticado
    return view('Comercio.edit', compact('comercio', 'usuario'));
}

    // Actualizar un comercio solo si pertenece al usuario autenticado
    public function update(Request $request, Comercio $comercio)
{
    // Verificar que el usuario autenticado es el propietario del comercio
    $comercio->idUsuario_fk !== auth()->id();

    // Validar los datos de la solicitud
    $validatedData = $request->validate([
        'nombreComercio' => 'required|max:100',
        'tipoNegocio' => 'required|max:100',
        'correoComercio' => 'required|email|unique:comercios,correoComercio,' . $comercio->idComercio . ',idComercio',
        'telefonoComercio' => 'nullable|max:20',
        'descripcionComercio' => 'nullable',
        'direccion_url' => 'required|string|max:500',
        'direccion_texto' => 'nullable|string|max:255',
        'imagen' => 'nullable|image|max:2048',
    ]);

    // Actualizar la información del comercio
    $comercio->update($validatedData);

    // Manejo de la imagen si se carga una nueva
    if ($request->hasFile('imagen')) {
        $file = $request->file('imagen');
        $destinationPath = 'img/imagen/';
        $fileName = time() . '-' . $file->getClientOriginalName();
        $file->move($destinationPath, $fileName);
        $comercio->imagen = $destinationPath . $fileName;
        $comercio->save();
    }

    // Redirigir con un mensaje de éxito
    return redirect()->route('comercios.index')->with('success', 'Comercio actualizado exitosamente.');
}

    // Eliminar un comercio solo si pertenece al usuario autenticado
    public function destroy(Comercio $comercio)
    {
        $this->authorize('delete', $comercio); // Asegurar que el usuario tiene acceso a este comercio
        $comercio->delete();
        return redirect()->route('comercios.index')->with('success', 'Comercio eliminado exitosamente.');
    }

    // Mostrar información de los comercios asociados al usuario autenticado
    public function mostrarInformacionComercios()
    {
        $comercios = Comercio::where('idUsuario_fk', Auth::id())->get();
        return view('frontend.comercios', compact('comercios'));
    }
}
