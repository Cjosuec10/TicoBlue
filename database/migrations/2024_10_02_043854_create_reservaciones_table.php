<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReservacionesTable extends Migration
{
    public function up()
    {
        Schema::create('reservaciones', function (Blueprint $table) {
            $table->id();
            $table->string('nombreUsuarioReservacion', 255);
            $table->string('correoUsuarioReservacion', 255);
            $table->string('telefonoUsuarioReservacion', 20)->nullable();
            $table->unsignedBigInteger('idComercio_fk');
            $table->unsignedBigInteger('idEvento_fk')->nullable(); // Debe ser nullable
            $table->unsignedBigInteger('idUsuario_fk');
            $table->unsignedBigInteger('idAlojamiento_fk')->nullable(); // Permitir nulos si es opcional
            $table->timestamps();

            // Claves foráneas
            $table->foreign('idComercio_fk')->references('idComercio')->on('comercios')->onDelete('cascade');
            $table->foreign('idEvento_fk')->references('idEvento')->on('eventos')->onDelete('cascade');
            $table->foreign('idUsuario_fk')->references('idUsuario')->on('usuarios')->onDelete('cascade');
            $table->foreign('idAlojamiento_fk')->references('idAlojamiento')->on('alojamiento')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('reservaciones');
    }
}
