<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    use HasFactory;

    protected $table = 'eventos';

    protected $fillable = [
        'nombreEvento',
        'descripcionEvento',
        'tipoEvento',
        'correoEvento',
        'telefonoEvento',
        'direccionEvento',
        'idComercio_fk',
    ];

    // Relación con el modelo Comercio
    public function comercio()
    {
        return $this->belongsTo(Comercio::class, 'idComercio_fk');
    }
}
