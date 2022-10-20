<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('puestos', function (Blueprint $table) {
            $table->id();

            $table->string('nombre');

            $table->unsignedBigInteger('departamento_id');
            $table->foreign('departamento_id')->references('id')->on('departamentos');

            // Composite unique key
            $table->unique(['nombre', 'departamento_id']);

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('puestos');
    }
};
