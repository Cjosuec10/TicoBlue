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

    protected $fillable = [
        'nombreAlojamiento',
        'descripcionAlojamiento',
        'precioAlojamiento',
        'capacidad',
        'imagen',
        'fechaInicio',
        'fechaFin',
        'idComercio_fk',
        'activo'
    ];
    public function comercio()
    {
        return $this->belongsTo(Comercio::class, 'idComercio_fk');
    }
    
    public function reservaciones()
{
    return $this->hasMany(Reservacion::class, 'idAlojamiento_fk');
}

}