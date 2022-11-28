<?php

namespace Database\Seeders;

use App\Models\DiaNoLaborable;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DiasNoLaborablesSeeder extends Seeder
{
    public function run()
    {
        $diasNoLaborales = [
            [
                'nombre' => 'Año Nuevo',
                'fecha' => '2022-01-01',
            ],
            [
                'nombre' => 'Feriado de Carnaval',
                'fecha' => '2022-02-28',
            ],
            [
                'nombre' => 'Feriado de Carnaval',
                'fecha' => '2022-02-28',
            ],
            [
                'nombre' => 'Día Nacional de la Memoria por la Verdad y la Justicia',
                'fecha' => '2022-03-24',
            ],
            [
                'nombre' => 'Día del Veterano y de los Caídos en la Guerra de Malvinas',
                'fecha' => '2022-04-02',
            ],
            [
                'nombre' => 'Viernes Santo',
                'fecha' => '2022-04-15',
            ],
            [
                'nombre' => 'Día del Trabajador',
                'fecha' => '2022-05-01',
            ],
            [
                'nombre' => 'Día de la Revolución de Mayo',
                'fecha' => '2022-05-25',
            ],
            [
                'nombre' => 'Paso a la Inmortalidad del General Martín Miguel de Güemes',
                'fecha' => '2022-06-17',
            ],
            [
                'nombre' => 'Paso a la Inmortalidad del General Manuel Belgrano',
                'fecha' => '2022-06-20',
            ],
            [
                'nombre' => 'Día de la Independencia',
                'fecha' => '2022-07-09',
            ],
            [
                'nombre' => 'Paso a la Inmortalidad del General José de San Martín',
                'fecha' => '2022-08-17',
            ],
            [
                'nombre' => 'Feriado con fines turísticos',
                'fecha' => '2022-10-07',
            ],
            [
                'nombre' => 'Día del Respeto a la Diversidad Cultural',
                'fecha' => '2022-10-12',
            ],
            [
                'nombre' => 'Feriado con fines turísticos',
                'fecha' => '2022-11-21',
            ],
            [
                'nombre' => 'Día de la Inmaculada Concepción de María',
                'fecha' => '2022-12-08',
            ],
            [
                'nombre' => 'Feriado con fines turísticos',
                'fecha' => '2022-12-09',
            ],
            [
                'nombre' => 'Navidad',
                'fecha' => '2022-12-25',
            ],
            [
                'nombre' => 'Año Nuevo',
                'fecha' => '2023-01-01',
            ]
        ];

        foreach ($diasNoLaborales as $diaNoLaboral) {
            DiaNoLaborable::create($diaNoLaboral);
        }
    }
}
