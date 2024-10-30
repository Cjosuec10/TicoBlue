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
        $comercios = auth()->user()->comercios->pluck('idComercio');
        $alojamientos = Alojamiento::whereIn('idComercio_fk', $comercios)->get();
        return view('alojamiento.index', compact('alojamientos'));
    }

    public function create()
    {
        $comercios = auth()->user()->comercios;
        return view('alojamiento.create', compact('comercios'));
    }

    public function store(Request $request)
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

        $validatedData['idUsuario_fk'] = auth()->id();

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

    public function mostrarAlojamientos()
    {
        $comercios = auth()->user()->comercios->pluck('idComercio');
        $alojamientos = Alojamiento::with('comercio')
                       ->whereIn('idComercio_fk', $comercios)
                       ->get();
        $usuarioLogueado = Auth::user();

        return view('frontend.alojamientos', compact('alojamientos', 'comercios', 'usuarioLogueado'));
    }
}
