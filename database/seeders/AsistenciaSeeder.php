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
        for ($i = 0; $i < 5250; $i++) {
            Asistencia::factory()->count(1)->create();
        }
    }
}
