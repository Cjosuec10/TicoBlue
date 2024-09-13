<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsuariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('usuarios')->insert([
            [
                'nombre' => 'Juan Pérez',
                'correo' => 'juan@example.com',
                'contrasena' => Hash::make('password123'), // Encriptamos la contraseña
                'telefono' => '123456789',
            ],
            [
                'nombre' => 'Maria López',
                'correo' => 'maria@example.com',
                'contrasena' => Hash::make('password123'),
                'telefono' => '987654321',
            ]
            // Puedes agregar más usuarios de prueba aquí
        ]);
    }
}
