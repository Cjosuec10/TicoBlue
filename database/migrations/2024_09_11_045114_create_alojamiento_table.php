<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlojamientoTable extends Migration
{
    public function up()
    {
        Schema::create('alojamiento', function (Blueprint $table) {
    $table->id('idAlojamiento');  // Clave primaria bigint unsigned
    $table->string('nombreAlojamiento', 100);
    $table->text('descripcionAlojamiento')->nullable();
    $table->decimal('precioAlojamiento', 10, 2);
    $table->integer('capacidad');
    $table->foreignId('idComercio_fk')->constrained('comercios','idComercio')->onDelete('cascade');  // Clave foránea que coincide con el tipo bigint unsigned
    $table->timestamps();
});

    }

    public function down()
    {
        Schema::dropIfExists('alojamiento');
    }
}