<?php

namespace Database\Seeders;

use App\Models\Empleado;
use App\Models\Incidencia;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class IncidenciaSeeder extends Seeder
{
    public function run()
    {
        // Run the factory with the model
        Incidencia::factory()->count(300)->create();

        // Create 25 incidencias for employee 1
        // $empleado = Empleado::find(1);
        // for ($i = 0; $i < 10; $i++) {
        //     Incidencia::factory()->count(1)->create([
        //         'empleado_id' => $empleado->id,
        //     ]);
        // }

    }
}
