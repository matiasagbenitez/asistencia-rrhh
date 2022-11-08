<?php

namespace Database\Seeders;

use App\Models\Incidencia;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class IncidenciaSeeder extends Seeder
{
    public function run()
    {
        // Run the factory with the model
        Incidencia::factory()->count(75)->create();
    }
}
