<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('tipos_de_incidencia', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->boolean('descuenta_sueldo')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tipos_de_incidencia');
    }
};
