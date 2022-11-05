<?php

namespace Database\Seeders;

use App\Models\Area;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AreaSeeder extends Seeder
{
    public function run()
    {
        $areas = [
            [
                'nombre' => 'Administración y Finanzas',
                'empresa_id' => 1,
            ],
            [
                'nombre' => 'Comercialización',
                'empresa_id' => 1,
            ],
            [
                'nombre' => 'Recursos Humanos',
                'empresa_id' => 1,
            ]
        ];

        Area::insert($areas);
    }
}
