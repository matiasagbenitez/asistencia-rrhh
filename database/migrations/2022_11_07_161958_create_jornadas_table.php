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
        Schema::create('jornadas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('categoria_de_horario_id');
            $table->foreign('categoria_de_horario_id')->references('id')->on('categorias_de_horarios');

            $table->string('dia');
            $table->string('tipo');
            $table->string('nombre');

            $table->time('hora_entrada');
            $table->time('hora_salida');
            $table->integer('tolerancia');

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
        Schema::dropIfExists('jornadas');
    }
};
