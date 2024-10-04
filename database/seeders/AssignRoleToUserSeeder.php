<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Usuario;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AssignRoleToUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Verificar si el usuario con id 1 existe, si no, crearlo
        $user = Usuario::find(1);
        if (!$user) {
            $user = Usuario::create([
                'nombre' => 'Admin',          // Ajusta estos campos a los que tenga tu modelo
                'correo' => 'admin@gmail.com',
                'contrasena' => bcrypt('12345678'), // Usa bcrypt para encriptar la contraseña
            ]);
            $this->command->info('Usuario con ID 1 creado.');
        }

        // Crear o buscar el rol
        $role = Role::firstOrCreate(['name' => 'Admin']);

        // Obtener todos los permisos
        $permissions = Permission::all();

        // Asignar todos los permisos al rol
        $role->syncPermissions($permissions);

        // Asignar el rol al usuario con ID 1
        $user->assignRole($role);

        $this->command->info('Rol y permisos asignados al usuario con ID 1 exitosamente.');
    }
}