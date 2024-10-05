<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservacion extends Model
{

    protected $primaryKey = 'idReservacion';
    // Definir la tabla asociada si no sigue la convención de nombres
    protected $table = 'reservaciones';

    // Definir los campos que se pueden llenar en masa (mass assignable)
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

    // Definir las relaciones con otros modelos

    // Relación con el modelo Comercio (obligatoria)
    public function comercio()
    {
        return $this->belongsTo(\App\Models\Comercio::class, 'idComercio_fk', 'idComercio');
    }

    // Relación con el modelo Evento (opcional)
    public function evento()
    {
        return $this->belongsTo(\App\Models\Evento::class, 'idEvento_fk', 'idEvento');
    }

    // Relación con el modelo Usuario (opcional)
    public function usuario()
    {
        return $this->belongsTo(\App\Models\Usuario::class, 'idUsuario_fk', 'idUsuario');
    }

    // Relación con el modelo Alojamiento (opcional)
    public function alojamiento()
    {
        return $this->belongsTo(\App\Models\Alojamiento::class, 'idAlojamiento_fk', 'idAlojamiento');
    }
}
