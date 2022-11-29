<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Asistencia;
use App\Models\Incidencia;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Database\Seeders\HoraExtraSeeder;
use Database\Seeders\IncidenciaSeeder;

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
            DiasNoLaborablesSeeder::class,
        ]);

        $incidencias = Incidencia::all();
        $asistencias = [];

        foreach ($incidencias as $incidencia) {
            $asistencias[] = Asistencia::where('empleado_id', $incidencia->empleado_id)
                ->whereBetween('fecha_hora_entrada', [$incidencia->fecha_hora_inicio, $incidencia->fecha_hora_fin]);
        }

        foreach ($asistencias as $asistencia) {
            $asistencia->delete();
        }

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
