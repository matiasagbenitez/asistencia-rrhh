<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\HoraExtraSeeder;
use Database\Seeders\IncidenciaSeeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
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
            AsistenciaSeeder::class,
            JornadaSeeder::class,
            PermissionSeeder::class,
            RoleSeeder::class,
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password'),
        ])->syncRoles(
            [
                Role::find(1)->name,
            ]
        );

        \App\Models\User::factory()->create([
            'name' => 'Empleado',
            'email' => 'empleado@admin.com',
            'password' => bcrypt('password'),
        ])->syncRoles(
            [
                Role::find(2)->name,
            ]
        );
    }
}
