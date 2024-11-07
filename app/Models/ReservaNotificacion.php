<?php

namespace App\Models;

use Illuminate\Notifications\DatabaseNotification;

class ReservaNotificacion extends DatabaseNotification
{
    // Especificar el nombre de la tabla
    protected $table = 'reservaNotificacion';
}
