<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use App\Models\Comercio;
use Illuminate\Http\Request;

class EventoController extends Controller
{
    public function index()
    {
        $eventos = Evento::all();
        return view('eventos.index', compact('eventos'));
    }

    public function create()
    {
        $comercios = Comercio::all();
        return view('eventos.create', compact('comercios'));
    }


public function store(Request $request)
{
// Validar los datos de la solicitud
$newevento = new Evento();

if( $request->hasFile('imagen')) {
    $file = $request->file('imagen');
    $destinationPath = 'img/imagen/';
    $fileName = time() . '-' . $file->getClientOriginalName();
    $uploadSuccess = $request->file('imagen')->move($destinationPath, $fileName);
    $newevento->imagen = $destinationPath . $fileName;

}
// $request->validate([
$newevento->nombreEvento = $request->nombreEvento;
$newevento->descripcionEvento = $request->descripcionEvento;
$newevento->tipoEvento = $request->tipoEvento;
$newevento->telefonoEvento = $request->telefonoEvento;
$newevento->correoEvento = $request->correoEvento;
$newevento->direccionEvento = $request->direccionEvento;
$newevento->idComercio_fk  = $request->idComercio_fk;
// $newevento->imagen = $request->imagen;

$newevento->save();

return redirect()->route('eventos.index')->with('success', 'Evento creado exitosamente.');


// Crear el comercio en la base de datos
Comercio::create($request->all());

// Redirigir a la lista de comercios con un mensaje de éxito
return redirect()->route('eventos.index')->with('success', 'Evento creado exitosamente.');
}

    public function show(Evento $evento)
    {
        return view('eventos.show', compact('evento'));
    }

    public function edit(Evento $evento)
    {
        $comercios = Comercio::all();
        return view('eventos.edit', compact('evento', 'comercios'));
    }

    public function update(Request $request, Evento $evento)
    {
        $request->validate([
            'nombreEvento' => 'required|max:100',
            'descripcionEvento' => 'nullable',
            'tipoEvento' => 'required|max:100',
            'correoEvento' => 'required|email',
            'telefonoEvento' => 'nullable|max:20',
            'direccionEvento' => 'nullable',
            'idComercio_fk' => 'required|exists:comercios,idComercio',
        ]);

        $evento->update($request->all());

        return redirect()->route('eventos.index')->with('success', 'Evento actualizado exitosamente.');
    }

    public function destroy(Evento $evento)
    {
        $evento->delete();
        return redirect()->route('eventos.index')->with('success', 'Evento eliminado exitosamente.');
    }
}
