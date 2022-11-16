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
                'descuenta_sueldo' => false,
            ],
            [
                'nombre' => 'Entrada',
                'descuenta_sueldo' => false,
            ],
            [
                'nombre' => 'Salida',
                'descuenta_sueldo' => false,
            ],
            [
                'nombre' => 'Falta injustificada',
                'descuenta_sueldo' => true,
            ],
            [
                'nombre' => 'Falta justificada',
                'descuenta_sueldo' => true,
            ],
            [
                'nombre' => 'Retraso',
                'descuenta_sueldo' => true,
            ],
            [
                'nombre' => 'Ausencia',
                'descuenta_sueldo' => true,
            ],
            [
                'nombre' => 'Permiso',
                'descuenta_sueldo' => false,
            ],
            [
                'nombre' => 'Vacaciones',
                'descuenta_sueldo' => false,
            ],
            [
                'nombre' => 'Incapacidad por maternidad',
                'descuenta_sueldo' => false,
            ],
            [
                'nombre' => 'Otro (no descuenta sueldo)',
                'descuenta_sueldo' => false,
            ],
            [
                'nombre' => 'Otro (descuenta sueldo)',
                'descuenta_sueldo' => true,
            ],
        ];

        TipoDeIncidencia::insert($tipos);
    }
}
