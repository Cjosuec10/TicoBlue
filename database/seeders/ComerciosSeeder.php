<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ComerciosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('comercios')->insert([
            [
                'nombreComercio' => 'Comercio A',
                'tipoNegocio' => 'Restaurante',
                'correoComercio' => 'contacto@comercioa.com',
                'telefonoComercio' => '123456789',
                'descripcionComercio' => 'Un restaurante muy popular.',
                'idUsuario_fk' => 1, // Referencia al primer usuario insertado
            ],
            [
                'nombreComercio' => 'Comercio B',
                'tipoNegocio' => 'Tienda de Ropa',
                'correoComercio' => 'contacto@comerciob.com',
                'telefonoComercio' => '987654321',
                'descripcionComercio' => 'Tienda especializada en ropa de moda.',
                'idUsuario_fk' => 1, // También referencia al primer usuario
            ],
            [
                'nombreComercio' => 'Comercio C',
                'tipoNegocio' => 'Cafetería',
                'correoComercio' => 'contacto@comercioc.com',
                'telefonoComercio' => '564738291',
                'descripcionComercio' => 'Cafetería con especialidad en postres.',
                'idUsuario_fk' => 2, // Referencia al segundo usuario
            ],
        ]);
    }
}
