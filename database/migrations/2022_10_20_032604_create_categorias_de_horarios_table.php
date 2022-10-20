<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('categorias_de_horarios', function (Blueprint $table) {
            $table->id();

            $table->string('nombre')->unique();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('categorias_de_horarios');
    }
};
