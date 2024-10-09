<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlojamientoTable extends Migration
{
    public function up()
    {
        Schema::create('alojamiento', function (Blueprint $table) {
            $table->id('idAlojamiento');
            $table->string('nombreAlojamiento', 100);
            $table->text('descripcionAlojamiento')->nullable();
            $table->decimal('precioAlojamiento', 10, 2);
            $table->integer('capacidad');
        
            // Relación con Comercio
            $table->unsignedBigInteger('idComercio_fk');
            $table->foreign('idComercio_fk')->references('idComercio')->on('comercios')->onDelete('cascade');
        
            $table->timestamps();
        });
        
        
    }

    public function down()
    {
        Schema::dropIfExists('alojamiento');
    }
}
