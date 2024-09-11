<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservacion extends Model
{
    use HasFactory;

    protected $table = 'reservaciones';

    protected $fillable = [
        'fechaInicio',
        'fechaFin',
        'nombreUsuarioReservacion',
        'correoUsuarioReservacion',
        'telefonoUsuarioReservacion',
        'idComercio_fk',
        'idEvento_fk',
        'idUsuario_fk',
        'idAlojamiento_fk',
    ];

    // Relación con el modelo Comercio
    public function comercio()
    {
        return $this->belongsTo(Comercio::class, 'idComercio_fk');
    }

    // Relación con el modelo Evento
    public function evento()
    {
        return $this->belongsTo(Evento::class, 'idEvento_fk');
    }

    // Relación con el modelo Usuario
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'idUsuario_fk');
    }

    // Relación con el modelo Alojamiento
    public function alojamiento()
    {
        return $this->belongsTo(Alojamiento::class, 'idAlojamiento_fk');
    }
}
