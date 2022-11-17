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
        // Empleado::all()->each(function ($empleado) {
        //     Asistencia::factory()->count(25)->create([
        //         'empleado_id' => $empleado->id,
        //     ]);
        // });

        // Execute Asistencia factory 750 times
        Asistencia::factory()->count(15)->create();
    }
}
