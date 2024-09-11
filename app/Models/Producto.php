<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $table = 'productos';

    protected $fillable = [
        'nombreProducto',
        'descripcionProducto',
        'precioProducto',
        'categoria',
        'idComercio_fk',
    ];

    // Relación con el modelo Comercio
    public function comercio()
    {
        return $this->belongsTo(Comercio::class, 'idComercio_fk');
    }
}