<?php

namespace Database\Seeders;

use App\Models\Empleado;
use App\Models\Asistencia;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AsistenciaSeeder extends Seeder
{
    public function run()
    {
        // Create 25 asistencias for each employee
        Empleado::all()->each(function ($empleado) {
            for ($i = 0; $i < 30; $i++) {
                Asistencia::factory()->count(1)->create();
            }
        });
    }
}
