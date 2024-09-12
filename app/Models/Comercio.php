<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comercio extends Model
{
    use HasFactory;

    protected $table = 'comercios';
    protected $primaryKey = 'idComercio';

    protected $fillable = [
        'nombreComercio',
        'tipoNegocio',
        'correoComercio',
        'telefonoComercio',
        'descripcionComercio',
        'idUsuario_fk',
    ];

   
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'idUsuario_fk');
    }
}
