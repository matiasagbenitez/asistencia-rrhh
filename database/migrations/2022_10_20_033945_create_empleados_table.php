<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('empleados', function (Blueprint $table) {
            $table->id();

            $table->string('nombre');
            $table->string('apellido');

            $table->string('cuil');
            $table->string('direccion');

            $table->date('fecha_ingreso');
            $table->date('fecha_egreso')->nullable();

            $table->unsignedBigInteger('puesto_id');
            $table->foreign('puesto_id')->references('id')->on('puestos');

            $table->unsignedBigInteger('categoria_horario_id');
            $table->foreign('categoria_horario_id')->references('id')->on('categorias_de_horarios');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('empleados');
    }
};
