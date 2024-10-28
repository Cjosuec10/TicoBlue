<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    // Especifica los campos que se pueden asignar masivamente
    protected $fillable = [
        'nombre',
        'email',
        'telefono',
        'tipo_consulta',
        'mensaje',
        'is_read', // Este campo lo utilizas para verificar si la notificación ha sido leída o no
    ];
}
