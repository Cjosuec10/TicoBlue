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
    $table->foreignId('idComercio_fk')->constrained('comercios','idComercio')->onDelete('cascade');  // Clave foránea que apunta a idComercio
    $table->foreignId('idEvento_fk')->constrained('eventos','idEvento')->onDelete('cascade');
    $table->foreignId('idUsuario_fk')->constrained('usuarios','idUsuario')->onDelete('cascade');
    $table->foreignId('idAlojamiento_fk')->constrained('alojamiento','idAlojamiento')->onDelete('cascade');
    $table->timestamps();
});

    }

    public function down()
    {
        Schema::dropIfExists('reservaciones');
    }
}