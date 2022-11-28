<?php

namespace App\Http\Livewire\Calendar;

use App\Models\Asistencia;
use App\Models\DiaNoLaborable;
use App\Models\Incidencia;
use Livewire\Component;

class Calendar extends Component
{
    public $events = [];
    public $year, $month;
    public $daysNames = ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'];
    public $selectedYear, $selectedMonth;

    public function mount()
    {
        $this->years = range(2020, 2022);
        $this->months = [
            1 => 'Enero',
            2 => 'Febrero',
            3 => 'Marzo',
            4 => 'Abril',
            5 => 'Mayo',
            6 => 'Junio',
            7 => 'Julio',
            8 => 'Agosto',
            9 => 'Septiembre',
            10 => 'Octubre',
            11 => 'Noviembre',
            12 => 'Diciembre',
        ];

        $this->selectedYear = date('Y');
        $this->selectedMonth = date('m');
    }

    public function render()
    {
        return view('livewire.calendar.calendar', [
            'days' => $this->getDaysInMonth(),
        ]);
    }

    public function getDaysInMonth()
    {
        $events = $this->getEventos();

        $daysOfMonth = cal_days_in_month(CAL_GREGORIAN, $this->selectedMonth, $this->selectedYear);
        $firstDay = $this->selectedYear . '-' . $this->selectedMonth . '-01';
        $dayOfWeek = date('w', strtotime($firstDay));

        for ($i = 0; $i < $dayOfWeek; $i++) {
            $days[] = [
                'day' => '',
                'events' => [],
            ];
        }

        for ($i = 0; $i < $daysOfMonth; $i++) {
            $days[] = [
                'day' => $i + 1,
                'events' => [],
            ];
        }

        foreach ($events as $event) {
            $diaEvento = date('j', strtotime($event['fecha']));
            foreach ($days as $key => $day) {
                if ($day['day'] == $diaEvento) {
                    $days[$key]['events'][] = $event['texto'];
                }
            }
        }

        $lastDay = $this->selectedYear . '-' . $this->selectedMonth . '-' . $daysOfMonth;
        $lastDayOfWeek = date('w', strtotime($lastDay));

        $colsToAdd = 6 - $lastDayOfWeek;
        for ($i = 0; $i < $colsToAdd; $i++) {
            $days[] = [
                'day' => '',
                'events' => [],
            ];
        }

        return $days;
    }

    public function getEventos()
    {
        $eventos = [];

        $diasNoLaborables = DiaNoLaborable::whereYear('fecha', $this->selectedYear)
            ->whereMonth('fecha', $this->selectedMonth)
            ->get();

        $incidencias = Incidencia::whereYear('fecha_hora_inicio', $this->selectedYear)
            ->whereMonth('fecha_hora_inicio', $this->selectedMonth);
            !auth()->user()->can('empleados') ? $incidencias->where('empleado_id', auth()->user()->id) : '';

        $incidencias = $incidencias->get();

        foreach ($diasNoLaborables as $item) {
            $eventos[] = ['texto' => $item->nombre, 'fecha' => $item->fecha];
        }

        foreach ($incidencias as $item) {
            $eventos[] = [
                'texto' => $item->tipoDeIncidencia->nombre,
                'fecha' => $item->fecha_hora_inicio,
            ];
        }
        // dd($eventos, $diasNoLaborables, $incidencias);
        return $eventos;
    }
}
