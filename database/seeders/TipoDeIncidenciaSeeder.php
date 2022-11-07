<?php

namespace Database\Seeders;

use App\Models\TipoDeIncidencia;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipoDeIncidenciaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tipos = [
            [
                'nombre' => 'Licencia',
            ],
            [
                'nombre' => 'Entrada',
            ],
            [
                'nombre' => 'Salida',
            ]
        ];

        TipoDeIncidencia::insert($tipos);
    }
}
