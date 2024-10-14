<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alojamiento extends Model
{
    use HasFactory;

       // Clave primaria de la tabla
    protected $primaryKey = 'idAlojamiento';

    protected $table = 'alojamiento';

   // protected $primaryKey = 'idAlojamiento';

    protected $fillable = [
        'nombreAlojamiento',
        'descripcionAlojamiento',
        'precioAlojamiento',
        'capacidad',
        'idComercio_fk'
    ];
}