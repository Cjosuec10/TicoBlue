<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->foreignId('idComercio_fk')->constrained('comercios','idComercio')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('eventos');
    }
}