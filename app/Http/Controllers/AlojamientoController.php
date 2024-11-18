<?php
namespace App\Http\Controllers;

use App\Models\Alojamiento;
use App\Models\Comercio;
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
    // Obtener el usuario autenticado
    $user = auth()->user();

    // Verificar si el usuario tiene el rol de administrador
    if ($user->hasRole('Admin')) {
        // Si es administrador, cargar todos los alojamientos
        $alojamientos = Alojamiento::all();
    } else {
        // Si no es administrador, cargar solo los alojamientos de los comercios del usuario
        $comercios = $user->comercios->pluck('idComercio');
        $alojamientos = Alojamiento::whereIn('idComercio_fk', $comercios)->get();
    }

    // Retornar la vista con los alojamientos
    return view('alojamiento.index', compact('alojamientos'));
}


    public function create()
    {
        $comercios = auth()->user()->comercios;
        return view('alojamiento.create', compact('comercios'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombreAlojamiento' => 'required|max:100',
            'descripcionAlojamiento' => 'nullable',
            'precioAlojamiento' => 'required|numeric',
            'capacidad' => 'required|integer',
            'idComercio_fk' => 'required|exists:comercios,idComercio',
            'imagen' => 'nullable|image|max:2048',
            'fechaInicio' => 'required|date',
            'fechaFin' => 'required|date|after_or_equal:fechaInicio',
        ]);

        $newAlojamiento = new Alojamiento($request->except('imagen'));

        if ($request->hasFile('imagen')) {
            $file = $request->file('imagen');
            $destinationPath = 'img/imagen/';
            $fileName = time() . '-' . $file->getClientOriginalName();
            $file->move($destinationPath, $fileName);
            $newAlojamiento->imagen = $destinationPath . $fileName;
        }

        $newAlojamiento->save();

        return redirect()->route('alojamiento.index')->with('success', '¡Reservación creada exitosamente!');
    }




    public function show($id)
    {
        $alojamiento = Alojamiento::findOrFail($id);
        return view('alojamiento.show', compact('alojamiento'));
    }

    public function edit($id)
    {
        $alojamiento = Alojamiento::findOrFail($id);
        $comercios = auth()->user()->comercios;
        return view('alojamiento.edit', compact('alojamiento', 'comercios'));
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

        $alojamiento = Alojamiento::findOrFail($id);
        $validatedData['idUsuario_fk'] = auth()->id();

        if ($request->hasFile('imagen')) {
            if ($alojamiento->imagen && file_exists(public_path($alojamiento->imagen))) {
                unlink(public_path($alojamiento->imagen));
            }
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
        if ($alojamiento->imagen && file_exists(public_path($alojamiento->imagen))) {
            unlink(public_path($alojamiento->imagen));
        }
        $alojamiento->delete();

        return redirect()->route('alojamiento.index')->with('success', 'Alojamiento eliminado con éxito.');
    }
    public function mostrarInformacionAlojamientos()
    {
       // Obtener solo los alojamientos activos
       $alojamientos = Alojamiento::with('comercio')->where('activo', true)->paginate(8);

    return view('frontend.alojamientos', compact('alojamientos'));
    }
    public function buscarAlojamientos(Request $request)
    {
        $query = $request->get('q');
        $page = $request->get('page', 1);
        $alojamientos = Alojamiento::with('comercio')
                        ->where('nombreAlojamiento', 'like', '%' . $query . '%')
                        ->paginate(8, ['*'], 'page', $page);

        return response()->json([
            'alojamientos' => $alojamientos->items(),
            'pagination' => $alojamientos->links('pagination::bootstrap-4')->render(),
        ]);
    }
    public function toggleActivation(Request $request, $id)
{
    $alojamiento = Alojamiento::findOrFail($id);
    $alojamiento->activo = $request->input('activo');
    $alojamiento->save();

    return response()->json(['success' => true]);
}

    public function activar($id)
    {
        $alojamientos = Alojamiento::findOrFail($id);
        $alojamientos->activo = true;
        $alojamientos->save();

        return redirect()->route('alojamiento.index')->with('success', 'Alojamiento activado exitosamente.');
    }

    public function desactivar($id)
    {
        $alojamientos = Alojamiento::findOrFail($id);
        $alojamientos->activo = false;
        $alojamientos->save();

        return redirect()->route('alojamiento.index')->with('success', 'Alojamiento desactivado exitosamente.');
    }

}
