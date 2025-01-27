<?php

namespace App\Http\Controllers;

use App\Models\Comercio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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


    // Mostrar todos los comercios pertenecientes al usuario autenticado
    // public function index(Request $request)
    // {
    //     $comercios = Comercio::where('idUsuario_fk', Auth::id());

    //     // Filtrar por el criterio de búsqueda si existe
    //     if ($request->has('buscar')) {
    //         $query = $request->input('buscar');
    //         $comercios = $comercios->where(function ($q) use ($query) {
    //             $q->where('nombreComercio', 'LIKE', "%{$query}%")
    //                 ->orWhere('tipoNegocio', 'LIKE', "%{$query}%")
    //                 ->orWhere('telefonoComercio', 'LIKE', "%{$query}%");
    //         });
    //     }

    //     // Obtener los comercios paginados
    //     $comercios = $comercios->paginate(10);

    //     return view('Comercio.index', compact('comercios'));
    // }

    public function index()
    {
        // Obtener el usuario autenticado
        $user = auth()->user();
    
        // Verificar si el usuario tiene el rol de administrador
        if ($user->hasRole('Admin')) {
            // Si es administrador, cargar todos los comercios
            $comercios = Comercio::all();
        } else {
            // Si no es administrador, cargar solo los comercios del usuario autenticado
            $comercios = $user->comercios;
        }
    
        // Pasar los comercios a la vista
        return view('Comercio.index', compact('comercios'));
    }

    public function mostrarInformacionComercios(Request $request)
    {
        // Obtener solo comercios activos, paginados
        $comercios = Comercio::where('activo', true)->paginate(8);

        // Verificar si es una solicitud AJAX para búsqueda
        if ($request->ajax()) {
            return view('frontend.comercios_lista', compact('comercios'))->render();
        }

        // Retornar la vista principal
        return view('frontend.comercios', compact('comercios'));
    }

    public function toggleActivation(Request $request, $id)
    {
        $comercio = Comercio::findOrFail($id);
        $comercio->activo = $request->input('activo');
        $comercio->save();

        return response()->json(['success' => true]);
    }

    public function buscar(Request $request)
{
    $query = $request->get('q');
    $page = $request->get('page', 1);

    // Realizar la búsqueda sin depender de un usuario autenticado
    $comercios = Comercio::where('activo', true) // Solo buscar comercios activos
                    ->where(function ($q) use ($query) {
                        $q->where('nombreComercio', 'LIKE', '%' . $query . '%')
                          ->orWhere('tipoNegocio', 'LIKE', '%' . $query . '%')
                          ->orWhere('telefonoComercio', 'LIKE', '%' . $query . '%');
                    })
                    ->paginate(8, ['*'], 'page', $page);

    // Retornar la respuesta en formato JSON
    return response()->json([
        'comercios' => $comercios->items(),
        'pagination' => $comercios->links('pagination::bootstrap-4')->render(),
    ]);
}


    public function buscarInformativo(Request $request)
    {
        $query = $request->input('q');

        // Obtener solo los comercios activos que coincidan con el criterio de búsqueda
        $comercios = Comercio::where('activo', true)
            ->where(function ($q) use ($query) {
                $q->where('nombreComercio', 'LIKE', "%{$query}%")
                    ->orWhere('tipoNegocio', 'LIKE', "%{$query}%")
                    ->orWhere('telefonoComercio', 'LIKE', "%{$query}%");
            })
            ->paginate(8);

        // Retornar comercios con paginación en la respuesta JSON
        return response()->json([
            'comercios' => $comercios->items(),
            'pagination' => (string) $comercios->links('pagination::bootstrap-4'),
        ]);
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
        $request->validate([
            'nombreComercio' => 'required|max:100',
            'tipoNegocio' => 'required|max:100',
            'correoComercio' => 'required|email|unique:comercios,correoComercio',
            'telefonoComercio' => 'nullable|max:20',
            'descripcionComercio' => 'nullable',
            'imagen' => 'nullable|image|max:2048',
            'direccion_url' => 'nullable|string|max:500',
            'direccion_texto' => 'nullable|string|max:255',
        ], [
            'direccion_url.max' => 'Asegúrese de que el ID del Mapa de Google tenga menos de 500 caracteres.',
        ]);
        $newcomercio = new Comercio($request->all());
        $newcomercio->idUsuario_fk = Auth::id(); // Asociar el comercio al usuario autenticado
        if ($request->hasFile('imagen')) {
            $file = $request->file('imagen');
            $destinationPath = 'img/imagen/';
            $fileName = time() . '-' . $file->getClientOriginalName();
            $file->move($destinationPath, $fileName);
            $newcomercio->imagen = $destinationPath . $fileName;
        }
        $newcomercio->save();
        return redirect()->route('comercios.index')->with('success', 'Comercio creado exitosamente.');
    }
    // Mostrar detalles de un comercio solo si pertenece al usuario autenticado
    
    public function show(Comercio $comercio)
{
    $user = auth()->user();

    // Permitir que el administrador acceda a cualquier comercio
    if ($user->hasRole('Admin')) {
        return view('Comercio.show', compact('comercio'));
    }

    // Verificar si el usuario autenticado es el dueño del comercio
    if ($comercio->idUsuario_fk !== $user->idUsuario) {
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
            'direccion_url' => 'nullable|string|max:500',
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

    // public function toggleActivation(Request $request, $id)
    // {
    //     $comercio = Comercio::findOrFail($id);
    //     $comercio->activo = $request->input('activo');
    //     $comercio->save();

    //     return response()->json(['success' => true, 'message' => 'Estado del comercio actualizado correctamente.']);
    // }

    // public function activar($id)
    // {
    //     $comercio = Comercio::findOrFail($id);
    //     $comercio->activo = true;
    //     $comercio->save();

    //     return redirect()->route('comercios.index')->with('success', 'Comercio activado exitosamente.');
    // }

    // public function desactivar($id)
    // {
    //     $comercio = Comercio::findOrFail($id);
    //     $comercio->activo = false;
    //     $comercio->save();

    //     return redirect()->route('comercios.index')->with('success', 'Comercio desactivado exitosamente.');
    // }



    public function activar($id)
    {
        $comercio = Comercio::findOrFail($id);
        $comercio->activo = true;
        $comercio->save();

        return redirect()->route('comercios.index')->with('success', 'Comercio activado exitosamente.');
    }

    public function desactivar($id)
    {
        $comercio = Comercio::findOrFail($id);
        $comercio->activo = false;
        $comercio->save();

        return redirect()->route('comercios.index')->with('success', 'Comercio desactivado exitosamente.');
    }
    // Eliminar un comercio solo si pertenece al usuario autenticado
    public function destroy(Comercio $comercio)
    {
        $this->authorize('delete', $comercio); // Asegurar que el usuario tiene acceso a este comercio
        $comercio->delete();
        return redirect()->route('comercios.index')->with('success', 'Comercio eliminado exitosamente.');
    }

    // Mostrar información de los comercios asociados al usuario autenticado
    // public function mostrarInformacionComercios()
    // {
    //     $comercios = Comercio::where('idUsuario_fk', Auth::id())->get();
    //     return view('frontend.comercios', compact('comercios'));
    // }
}
