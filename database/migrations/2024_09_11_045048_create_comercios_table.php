<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComerciosTable extends Migration
{
    public function up()
    {
        Schema::create('comercios', function (Blueprint $table) {
            $table->id('idComercio');
            $table->string('nombreComercio', 100);
            $table->string('tipoNegocio', 100);
            $table->string('correoComercio', 100)->unique();
            $table->string('telefonoComercio', 20)->nullable();
            $table->text('descripcionComercio')->nullable();
            $table->string('imagen')->nullable();             // Agregamos la columna imagen
            $table->string('direccion_url')->nullable();      // Campo para una dirección (enlace)
            $table->string('direccion_texto')->nullable();    // Campo para una dirección en texto
            $table->foreignId('idUsuario_fk')->constrained('usuarios', 'idUsuario')->onDelete('cascade');
            $table->timestamps();
        });

    }

    public function down()
    {
        Schema::dropIfExists('comercios');
    }
}