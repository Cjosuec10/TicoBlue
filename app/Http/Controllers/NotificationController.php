<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function store(Request $request)
    {
         // Verificar el token de reCAPTCHA
      $response = $request->input('g-recaptcha-response');
      $recaptchaSecret = config('services.recaptcha.secret_key');
  
      $client = new \GuzzleHttp\Client();
      $recaptchaResponse = $client->post('https://www.google.com/recaptcha/api/siteverify', [
          'form_params' => [
              'secret' => $recaptchaSecret,
              'response' => $response,
              'remoteip' => $request->ip(),
          ]
      ]);
  
      $recaptchaData = json_decode($recaptchaResponse->getBody());
  
      if (!$recaptchaData->success) {
          return response()->json(['success' => false, 'message' => 'Completa el reCAPTCHA correctamente.'], 422);
      }
 
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

        //Mostrar el listado de notificaciones 

    public function allNotifications()
    {
     // Obtiene todas las notificaciones, sin importar si están leídas o no
     $allNotifications = Notification::all();
    
     return view('notifications.all', compact('allNotifications'));

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