<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

//agregamos el modelo de permisos de spatie
use Spatie\Permission\Models\Permission;

class SeederTablaPermisos extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permisos = [
            // Operaciones sobre tabla roles
            'ver-rol',
            'crear-rol',
            'editar-rol',
            'borrar-rol',
        
            // Operaciones sobre tabla usuarios
            'ver-usuario',
            'crear-usuario',
            'editar-usuario',
            'borrar-usuario',
        
            // Operaciones sobre tabla alojamientos
            'ver-alojamiento',
            'crear-alojamiento',
            'editar-alojamiento',
            'borrar-alojamiento',
        
            // Operaciones sobre tabla comercios
            'ver-comercio',
            'crear-comercio',
            'editar-comercio',
            'borrar-comercio',
        
            // Operaciones sobre tabla eventos
            'ver-evento',
            'crear-evento',
            'editar-evento',
            'borrar-evento',
        
            // Operaciones sobre tabla productos
            'ver-producto',
            'crear-producto',
            'editar-producto',
            'borrar-producto',
        
            // Operaciones sobre tabla reservaciones
            'ver-reservacion',
            'crear-reservacion',
            'editar-reservacion',
            'borrar-reservacion',
        
           
        ];
        

        foreach($permisos as $permiso) {
            Permission::create(['name'=>$permiso]);
        }
    }
}
