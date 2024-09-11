<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
    $table->foreignId('idComercio_fk')->constrained('comercios','idComercio')->onDelete('cascade');  // Asegúrate de que coincidan los tipos de dato
    $table->timestamps();
});

    }

    public function down()
    {
        Schema::dropIfExists('productos');
    }
}