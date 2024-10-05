<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Usuario extends Authenticatable
{
    use Notifiable, HasRoles;

    // Definir el nombre de la tabla
    protected $table = 'usuarios';
    protected $primaryKey = 'idUsuario';

    // Las columnas que se pueden llenar automáticamente
    protected $fillable = [
        'nombre',
        'correo',
        'contrasena',
        'telefono',
    ];

    // Especificar el campo de contraseña
    protected $hidden = [
        'contrasena', 'remember_token',
    ];

    // Definir el nombre del campo utilizado como identificador para el login
    protected $username = 'correo';

    // Especificar cómo Laravel debe obtener la contraseña
    public function getAuthPassword()
    {
        return $this->contrasena;
    }
}
