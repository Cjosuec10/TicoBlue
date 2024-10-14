<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservacion extends Model
{
    protected $table = 'reservaciones';
    protected $primaryKey = 'idReservacion';

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

    // Definir las relaciones
    public function comercio()
    {
        return $this->belongsTo(Comercio::class, 'idComercio_fk');
    }

    public function evento()
    {
        return $this->belongsTo(Evento::class, 'idEvento_fk');
    }

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'idUsuario_fk');
    }

    public function alojamiento()
    {
        return $this->belongsTo(Alojamiento::class, 'idAlojamiento_fk');
    }
}
