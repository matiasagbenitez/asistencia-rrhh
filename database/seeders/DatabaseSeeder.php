<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\HoraExtraSeeder;
use Database\Seeders\IncidenciaSeeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        \App\Models\User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password'),
        ]);

        $this->call([
            EmpresaSeeder::class,
            AreaSeeder::class,
            DepartamentoSeeder::class,
            PuestoSeeder::class,
            CategoriasDeHorariosSeeder::class,
            EmpleadoSeeder::class,
            TipoDeIncidenciaSeeder::class,
            IncidenciaSeeder::class,
            HoraExtraSeeder::class,
        ]);
    }
}
