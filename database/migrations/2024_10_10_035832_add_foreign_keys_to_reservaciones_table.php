<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('reservaciones', function (Blueprint $table) {
            //
            $table->foreign('idComercio_fk')->references('idComercio')->on('comercios')->onDelete('cascade');
            $table->foreign('idEvento_fk')->references('idEvento')->on('eventos')->onDelete('cascade');
            $table->foreign('idUsuario_fk')->references('idUsuario')->on('usuarios')->onDelete('cascade');
            $table->foreign('idAlojamiento_fk')->references('idAlojamiento')->on('alojamiento')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reservaciones', function (Blueprint $table) {
            //
            $table->dropForeign(['idComercio_fk']);
            $table->dropForeign(['idEvento_fk']);
            $table->dropForeign(['idUsuario_fk']);
            $table->dropForeign(['idAlojamiento_fk']);
        });
    }
};
