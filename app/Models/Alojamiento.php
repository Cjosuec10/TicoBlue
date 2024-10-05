<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alojamiento extends Model
{
    use HasFactory;

    protected $table = 'alojamiento';

    protected $primaryKey = 'idAlojamiento';

    protected $fillable = [
        'nombreAlojamiento',
        'descripcionAlojamiento',
        'precioAlojamiento',
        'capacidad',
        'idComercio_fk',
    ];

    // Relación con el modelo Comercio
    public function comercio()
    {
        return $this->belongsTo(Comercio::class, 'idComercio_fk');
    }
}
