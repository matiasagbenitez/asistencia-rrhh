<?php

namespace App\Http\Livewire\Empleados\Asistencias;

use Livewire\Component;
use App\Models\Asistencia;
use Illuminate\Support\Facades\Date;

class EditAsistencia extends Component
{
    public $isOpen = 0;
    public $asistencia;

    public $form = [
        'fecha_hora_entrada' => '',
        'fecha_hora_salida' => '',
        'cantidad_horas' => '',
        'empleado_id' => '',
    ];

    protected $validationAttributes = [
        'form.fecha_hora_inicio' => 'Fecha y hora de inicio',
        'form.fecha_hora_fin' => 'Fecha y hora de fin',
    ];

    public function mount(Asistencia $asistencia)
    {
        $this->asistencia = $asistencia;
    }

    public function render()
    {
        return view('livewire.empleados.asistencias.edit-asistencia');
    }

    public function editAsistencia()
    {
        $this->toggleModal();
        $this->form = [
            'fecha_hora_entrada' => $this->asistencia->fecha_hora_entrada,
            'fecha_hora_salida' => $this->asistencia->fecha_hora_salida,
            'cantidad_horas' => $this->asistencia->cantidad_horas,
            'empleado_id' => $this->asistencia->empleado_id,
        ];
    }

    public function toggleModal()
    {
        $this->isOpen = !$this->isOpen;
        $this->resetErrorBag();
    }

    public function update()
    {
        $this->validate([
            'form.fecha_hora_entrada' => 'required|before:form.fecha_hora_salida',
            'form.fecha_hora_salida' => 'required|after:form.fecha_hora_entrada',
            'form.empleado_id' => 'required',
        ]);
        $this->form['cantidad_horas'] = Date::parse($this->form['fecha_hora_salida'])->diffInMinutes($this->form['fecha_hora_entrada']) / 60;
        $this->asistencia->update($this->form);
        $this->toggleModal();
        $this->emitTo('empleados.asistencias.index-asistencia', 'render');
        $this->emit('success', '¡La asistencia se actualizó correctamente!');
    }
}
