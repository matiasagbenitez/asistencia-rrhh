<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('incidencias', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('empleado_id');
            $table->foreign('empleado_id')->references('id')->on('empleados');

            $table->unsignedBigInteger('tipo_de_incidencia_id');
            $table->foreign('tipo_de_incidencia_id')->references('id')->on('tipos_de_incidencia');

            $table->dateTime('fecha_hora_inicio');
            $table->dateTime('fecha_hora_fin')->nullable();
            $table->boolean('aprobado')->default(1);

            $table->text('descripcion')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('incidencias');
    }
};
