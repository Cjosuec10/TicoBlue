<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventosTable extends Migration
{
    public function up()
    {
        Schema::create('eventos', function (Blueprint $table) {
            $table->id('idEvento');
            $table->string('nombreEvento', 100);
            $table->text('descripcionEvento')->nullable();
            $table->string('tipoEvento', 100)->nullable();
            $table->string('correoEvento', 100)->nullable();
            $table->string('telefonoEvento', 20)->nullable();
            $table->string('direccionEvento', 255)->nullable();
            $table->unsignedBigInteger('idComercio_fk');
            $table->foreign('idComercio_fk')->references('idComercio')->on('comercios')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('eventos');
    }
}

