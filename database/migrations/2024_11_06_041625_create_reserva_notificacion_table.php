<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservaNotificacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservaNotificacion', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('type'); // Almacena el tipo de notificación (nombre de la clase de notificación)
            $table->morphs('notifiable'); // Almacena el ID y tipo del modelo notifiable (e.g., Usuario)
            $table->text('data'); // Datos de la notificación en formato JSON
            $table->timestamp('read_at')->nullable(); // Fecha de lectura (si ya fue leída)
            $table->timestamps(); // Campos `created_at` y `updated_at`
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservaNotificacion');
    }
}

