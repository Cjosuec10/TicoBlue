<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->string('imagen')->nullable();
            $table->string('direccion_url')->nullable();
            $table->string('direccion_texto')->nullable();
            $table->unsignedBigInteger('idUsuario_fk');
            $table->foreign('idUsuario_fk')->references('idUsuario')->on('usuarios')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('comercios');
    }
}
