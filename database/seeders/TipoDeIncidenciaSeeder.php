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
                'nombre' => 'Licencia médica',
            ],
            [
                'nombre' => 'Entrada',
            ],
            [
                'nombre' => 'Salida',
            ],
            [
                'nombre' => 'Falta injustificada',
            ],
            [
                'nombre' => 'Falta justificada',
            ],
            [
                'nombre' => 'Retraso',
            ],
            [
                'nombre' => 'Ausencia',
            ],
            [
                'nombre' => 'Permiso',
            ],
            [
                'nombre' => 'Vacaciones',
            ],
            [
                'nombre' => 'Incapacidad por maternidad',
            ],
            [
                'nombre' => 'Otro',
            ],
        ];

        TipoDeIncidencia::insert($tipos);
    }
}
