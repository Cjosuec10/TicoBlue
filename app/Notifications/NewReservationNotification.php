<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use App\Models\ReservaNotificacion; // Importa el modelo personalizado

class NewReservationNotification extends Notification
{
    use Queueable;

    protected $reservationDetails;

    public function __construct(array $reservationDetails)
    {
        $this->reservationDetails = $reservationDetails;
    }

    public function via($notifiable): array
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'title' => 'Nueva Reservación',
            'message' => 'Se ha realizado una nueva reservación por el usuario: ' . $this->reservationDetails['nombreUsuarioReservacion'],
            'reservation_id' => $this->reservationDetails['id'],
            'user_id' => $notifiable->id,
            'user_name' => $this->reservationDetails['nombreUsuarioReservacion'],
        ];
    }
}
