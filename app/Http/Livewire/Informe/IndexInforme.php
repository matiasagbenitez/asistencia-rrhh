<?php

namespace App\Http\Livewire\Informe;

use App\Http\Services\InformeService;
use App\Models\Empleado;
use Carbon\Carbon;
use Livewire\Component;

class IndexInforme extends Component
{
    public $empleado;

    public $collections = [
        'empleados' => [],
    ];

    public $filtros = [
        'fecha_inicio' => '',
        'fecha_fin' => '',
        'empleado_id' => '',
    ];

    // Optional parameter on mount
    public function mount()
    {
        $this->collections['empleados'] = Empleado::all();

        if (request()->empleado) {
            $this->empleado = Empleado::where('id', request()->empleado)->first();
            $this->filtros['empleado_id'] = $this->empleado->id;
        }

        $this->filtros['fecha_inicio'] = Carbon::create(2022, 11, 1)->format('Y-m-d');
        $this->filtros['fecha_fin'] = Carbon::now()->format('Y-m-d');
    }

    public function updatedFiltrosEmpleadoId()
    {
        $this->empleado = Empleado::where('id', $this->filtros['empleado_id'])->first();
    }

    public function render()
    {
        $this->empleado = Empleado::find($this->filtros['empleado_id']);
        $stats = $this->getStats($this->empleado);

        return view('livewire.informe.index-informe', compact('stats'));
    }

    public function getStats($empleado)
    {
        if (!is_null($empleado)) {
            $asistencias = InformeService::asistencias(
                $empleado,
                $this->filtros['fecha_inicio'],
                $this->filtros['fecha_fin']
            );
            $listadoAsistencias = InformeService::listadoAsistencias(
                $empleado,
                $this->filtros['fecha_inicio'],
                $this->filtros['fecha_fin']
            );
            $horasExtras = InformeService::horasExtras(
                $empleado,
                $this->filtros['fecha_inicio'],
                $this->filtros['fecha_fin']
            );
            $listadoHorasExtra = InformeService::listadoHorasExtra(
                $empleado,
                $this->filtros['fecha_inicio'],
                $this->filtros['fecha_fin']
            );
            $horasTrabajadas = InformeService::horasTrabajadas(
                $empleado,
                $this->filtros['fecha_inicio'],
                $this->filtros['fecha_fin']
            );
            $faltasJustificadas = InformeService::faltasJustificadas(
                $empleado,
                $this->filtros['fecha_inicio'],
                $this->filtros['fecha_fin']
            );
            $faltasInjustificadas = InformeService::faltasInjustificadas(
                $empleado,
                $this->filtros['fecha_inicio'],
                $this->filtros['fecha_fin']
            );
            return [
                'empleado' => $empleado,
                'asistencias' => $asistencias,
                'listado_asistencias' => $listadoAsistencias,
                'horasTrabajadas' => $horasTrabajadas,
                'faltasJustificadas' => $faltasJustificadas,
                'faltasInjustificadas' => $faltasInjustificadas,
                'horasExtras' => $horasExtras,
                'listado_horas_extra' => $listadoHorasExtra,
            ];
        }
        return null;
    }
}
