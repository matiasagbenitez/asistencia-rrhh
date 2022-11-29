<?php

namespace App\Http\Livewire\Informe;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\Empleado;
use App\Charts\FaltasChart;
use Termwind\Components\Dd;
use App\Charts\AsistenciasChart;
use App\Charts\HorasExtrasChart;
use Illuminate\Support\Facades\Date;
use App\Http\Services\InformeService;
use Illuminate\Http\Client\Request;

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
        if (request()->empleado_id) {
            $this->empleado = Empleado::where('id', request()->empleado_id)->first();
            $this->filtros['empleado_id'] = $this->empleado->id;
        }

        if (isset(request()->fecha_inicio)) {
            $this->filtros['fecha_inicio'] = Carbon::create(request()->fecha_inicio)->format('Y-m-d');
        } else {
            $this->filtros['fecha_inicio'] = Carbon::create(2022, 11, 01)->format('Y-m-d');
        }

        if (isset(request()->fecha_fin)) {
            $this->filtros['fecha_fin'] = Carbon::create(request()->fecha_fin)->format('Y-m-d');
        } else {
            $this->filtros['fecha_fin'] = Carbon::now()->format('Y-m-d');
        }

    }

    public function updatedFiltrosEmpleadoId()
    {
        $this->empleado = Empleado::where('id', $this->filtros['empleado_id'])->first();
    }

    public function render()
    {
        $this->empleado = Empleado::find($this->filtros['empleado_id']);
        $stats = $this->getStats($this->empleado);
        $emptyData = [
            'faltas' => 0,
            'asistencias' => 0,
            'horas_extras' => 0,
        ];

        if (!is_null($this->empleado)) {

            // Gráfico 1. Circular, contiene faltas justificadas e injustificadas
            $faltasJustificadas = $stats['graficos']['faltasJustificadas'];
            $faltasInjustificadas = $stats['graficos']['faltasInjustificadas'];
            $faltasChart = new FaltasChart;
            if ($faltasJustificadas == 0 && $faltasInjustificadas == 0) {
                $emptyData['faltas'] = 1;
            }
            $faltasChart->labels(['Faltas justificadas', 'Faltas injustificadas'])->options([
                'legend' => [
                    'display' => true,
                    'position' => 'bottom',
                    'labels' => [
                        'boxWidth' => 10,
                        'fontSize' => 13,
                    ],
                ],
                'scales' => ['xAxes' => [['display' => false,],], 'yAxes' => [['display' => false,],],],
            ]);
            $faltasChart->dataset('Faltas', 'pie', [$faltasJustificadas, $faltasInjustificadas])->options([
                'backgroundColor' => ['#fdba74', '#fca5a5',],
            ]);



            // Gráfico 2. Circular, contiene asistencias, faltas justificadas e injustificadas
            $asistencias = $stats['graficos']['asistencias'];
            $asistenciasChart = new AsistenciasChart;
            if ($asistencias == 0 && $faltasJustificadas == 0 && $faltasInjustificadas == 0) {
                $emptyData['asistencias'] = 1;
            }
            $asistenciasChart->labels(['Asistencias', 'Faltas justificadas', 'Faltas injustificadas'])->options([
                'legend' => [
                    'display' => true,
                    'position' => 'bottom',
                    'labels' => [
                        'boxWidth' => 10,
                        'fontSize' => 13,
                    ],
                ],
                'scales' => ['xAxes' => [['display' => false,],], 'yAxes' => [['display' => false,],],],
            ]);
            $asistenciasChart->dataset('Asistencias', 'pie', [$asistencias, $faltasJustificadas, $faltasInjustificadas])->options([
                'backgroundColor' => ['#86efac', '#fdba74', '#fca5a5'],
            ]);



            // Gráfico 3. Barra, contiene las horas extras trabajadas en el año
            $horasExtrasChart = new HorasExtrasChart;
            $horasExtrasChart->labels(array_keys($stats['graficos']['horasExtras']))->options([
                'legend' => [
                    'display' => true,
                    'position' => 'bottom',
                    'labels' => [
                        'boxWidth' => 10,
                        'fontSize' => 13,
                    ],
                ],
            ]);
            $horasExtrasChart->dataset('Horas extras', 'bar', array_values($stats['graficos']['horasExtras']))->options([
                'backgroundColor' => '#d4d4d8',
            ]);

            return view('livewire.informe.index-informe', compact('stats', 'faltasChart', 'asistenciasChart', 'horasExtrasChart', 'emptyData'));
        }

        return view('livewire.informe.index-informe', compact('stats'));
    }

    public function getStats($empleado)
    {
        if (!is_null($empleado)) {

            // Agregar un dia a $this->filtros['fecha_fin']
            $fecha_fin = Carbon::parse($this->filtros['fecha_fin'])->addDay()->format('Y-m-d');

            $asistencias = InformeService::asistencias(
                $empleado,
                $this->filtros['fecha_inicio'],
                $fecha_fin
            );
            $listadoAsistencias = InformeService::listadoAsistencias(
                $empleado,
                $this->filtros['fecha_inicio'],
                $fecha_fin
            );
            $horasExtras = InformeService::horasExtras(
                $empleado,
                $this->filtros['fecha_inicio'],
                $fecha_fin
            );
            $listadoHorasExtra = InformeService::listadoHorasExtra(
                $empleado,
                $this->filtros['fecha_inicio'],
                $fecha_fin
            );
            $horasTrabajadas = InformeService::horasTrabajadas(
                $empleado,
                $this->filtros['fecha_inicio'],
                $fecha_fin
            );
            $faltasJustificadas = InformeService::faltasJustificadas(
                $empleado,
                $this->filtros['fecha_inicio'],
                $fecha_fin
            );
            $faltasInjustificadas = InformeService::faltasInjustificadas(
                $empleado,
                $this->filtros['fecha_inicio'],
                $fecha_fin
            );

            // Este es el array con los datos de exceso de horas
            // [
            // 'cantidadDeHoras' => Float,
            // 'horasTrabajadas' => Float,
            // 'exceso' => Float
            // ];
            $excesoHoras = InformeService::excesoHoras(
                $empleado,
                $this->filtros['fecha_inicio'],
                $fecha_fin
            );

            // Este es el array con los datos para los gráficos
            // [
            //     'horasExtras' => Array,
            //     'asistencias' => Integer,
            //     'faltasJustificadas' => Integer,
            //     'faltasInjustificadas' => Integer,
            // ];
            $graficos = InformeService::calcularGraficos(
                $empleado,
                $this->filtros['fecha_inicio'],
                $fecha_fin
            );

            return [
                'empleado' => $empleado,
                'graficos' => $graficos,
                'excesoHoras' => $excesoHoras,
                'asistencias' => $asistencias,
                'horasExtras' => $horasExtras,
                'horasTrabajadas' => $horasTrabajadas,
                'listado_horas_extra' => $listadoHorasExtra,
                'faltasJustificadas' => $faltasJustificadas,
                'listado_asistencias' => $listadoAsistencias,
                'faltasInjustificadas' => $faltasInjustificadas,
            ];
        }
        return null;
    }
}
