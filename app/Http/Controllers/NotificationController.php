<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function store(Request $request)
{
    // Validar la solicitud
    $request->validate([
        'nombre' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'telefono' => 'nullable|string|max:20',
        'tipo_consulta' => 'required|string|max:255',
        'mensaje' => 'required|string',
    ]);

    // Crear una nueva notificación
    Notification::create([
        'nombre' => $request->nombre,
        'email' => $request->email,
        'telefono' => $request->telefono,
        'tipo_consulta' => $request->tipo_consulta,
        'mensaje' => $request->mensaje,
        'is_read' => false, // Establecer is_read en false por defecto
    ]);

    // Redireccionar o mostrar un mensaje de éxito
    return redirect()->back()->with('success', 'Formulario enviado correctamente.');
}

    public function index()
    {
        // Obtener todas las notificaciones no leídas
        $notifications = Notification::where('is_read', false)->get();

        return view('notifications.index', compact('notifications'));
    }

    public function markAsRead($id)
    {
        // Marcar la notificación como leída
        $notification = Notification::find($id);
        $notification->is_read = true;
        $notification->save();

        return redirect()->back();
    }

    
}