<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incidencias', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('descripcion')->nullable();
            $table->dateTime('fecha_hora');
            $table->boolean('descontar')->default(false);
            $table->unsignedBigInteger('empleado_id');
            $table->unsignedBigInteger('tipo_de_incidencia_id');
            $table->foreign('empleado_id')->references('id')->on('empleados');
            $table->foreign('tipo_de_incidencia_id')->references('id')->on('tipos_de_incidencia');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('incidencias');
    }
};
