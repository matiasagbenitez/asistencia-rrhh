<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmpresaSeeder extends Seeder
{
    public function run()
    {
        $empresa = [
            'nombre' => 'Hipermercado Libertad',
            'cuit' => '20-12345678-9',
            'razon_social' => 'Hipermecado Libertad S.A.',
            'direccion' => 'Av. Tomás Guido 6070',
        ];

        \App\Models\Empresa::create($empresa);
    }
}
