<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductosTable extends Migration
{
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id('idProducto');
            $table->string('nombreProducto', 100);
            $table->text('descripcionProducto')->nullable();
            $table->decimal('precioProducto', 10, 2);
            $table->string('categoria', 100)->nullable();
            $table->unsignedBigInteger('idComercio_fk');
            $table->string('imagenProducto')->nullable();
            $table->foreign('idComercio_fk')->references('idComercio')->on('comercios')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('productos');
    }
}

