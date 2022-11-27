<?php

namespace App\Http\Livewire\Calendario;

use App\Models\Asistencia;
use App\Models\Empleado as ModelsEmpleado;
use Livewire\Component;

class Empleado extends Component
{
    public $empleado;

    public function mount()
    {
        if (request()->empleado) {
            $this->empleado = ModelsEmpleado::where('user_id', request()->empleado)->first();
            $this->asistencia = $this->getAsistencia($this->empleado);
        } else {
            abort(404);
        }
    }

    public function render()
    {
        if ($this->empleado) {
            $this->asistencia = $this->getAsistencia($this->empleado);
        }
        return view('livewire.calendarios.empleado');
    }

    public function marcarAsistencia()
    {
        if ($this->asistencia) {
            if ($this->asistencia->fecha_hora_salida) {
                $this->asistencia = Asistencia::create([
                    'fecha_hora_entrada' => now(),
                    'empleado_id' => $this->empleado->id,
                ]);
            } else {
                $this->asistencia->fecha_hora_salida = now();
                $this->asistencia->cantidad_horas = $this->asistencia->fecha_hora_salida
                    ->diffInMinutes($this->asistencia->fecha_hora_entrada) / 60;
                $this->asistencia->save();
            }
        }
    }

    public function getAsistencia($empleado)
    {
        return Asistencia::where('empleado_id', $empleado->id)
            ->orderBy('created_at', 'desc')
            ->first();
    }
}
