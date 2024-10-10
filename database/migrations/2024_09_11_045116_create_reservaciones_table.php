<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservacionesTable extends Migration
{
    public function up()
    {
        Schema::create('reservaciones', function (Blueprint $table) {
            $table->id('idReservacion');
            $table->date('fechaInicio');
            $table->date('fechaFin');
            $table->string('nombreUsuarioReservacion', 100);
            $table->string('correoUsuarioReservacion', 100);
            $table->string('telefonoUsuarioReservacion', 20)->nullable();
            $table->unsignedBigInteger('idComercio_fk');
            $table->unsignedBigInteger('idEvento_fk')->nullable();
            $table->unsignedBigInteger('idUsuario_fk')->nullable();
            $table->unsignedBigInteger('idAlojamiento_fk')->nullable();
            $table->foreign('idComercio_fk')->references('idComercio')->on('comercios')->onDelete('cascade');
            $table->foreign('idEvento_fk')->references('idEvento')->on('eventos')->onDelete('cascade');
            $table->foreign('idUsuario_fk')->references('idUsuario')->on('usuarios')->onDelete('cascade');
            $table->foreign('idAlojamiento_fk')->references('idAlojamiento')->on('alojamiento')->onDelete('cascade');
            $table->timestamps();
});

    }

    public function down()
    {
        Schema::dropIfExists('reservaciones');
    }
}
