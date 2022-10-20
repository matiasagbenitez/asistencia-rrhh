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
                'nombre' => 'Dirección',
                'empresa_id' => 1,
            ],
            [
                'nombre' => 'Administración',
                'empresa_id' => 1,
            ],
            [
                'nombre' => 'Ventas',
                'empresa_id' => 1,
            ],
            [
                'nombre' => 'Producción',
                'empresa_id' => 1,
            ],
            [
                'nombre' => 'Contabilidad',
                'empresa_id' => 1,
            ]
        ];

        Area::insert($areas);
    }
}
