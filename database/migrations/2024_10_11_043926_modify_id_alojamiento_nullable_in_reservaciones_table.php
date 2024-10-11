<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('reservaciones', function (Blueprint $table) {
            $table->unsignedBigInteger('idAlojamiento_fk')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('reservaciones', function (Blueprint $table) {
            $table->unsignedBigInteger('idAlojamiento_fk')->nullable(false)->change();
        });
    }
};
