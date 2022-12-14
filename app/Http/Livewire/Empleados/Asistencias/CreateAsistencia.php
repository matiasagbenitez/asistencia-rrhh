<?php

namespace App\Http\Livewire\Empleados\Asistencias;

use Livewire\Component;
use App\Models\Asistencia;
use Illuminate\Support\Facades\Date;

class CreateAsistencia extends Component
{
    public $isOpen = 0;
    public $collections;

    public $form = [
        'fecha_hora_entrada' => '',
        'fecha_hora_salida' => '',
        'cantidad_horas' => '',
        'empleado_id' => '',
    ];

    public function mount($empleado)
    {
        $this->empleado = $empleado;
    }

    public function render()
    {
        return view('livewire.empleados.asistencias.create-asistencia');
    }

    protected $rules = [
        'form.fecha_hora_entrada' => 'required|before:form.fecha_hora_salida',
        'form.fecha_hora_salida' => 'required|after:form.fecha_hora_entrada',
        'form.empleado_id' => 'required',
    ];

    protected $validationAttributes = [
        'form.fecha_hora_entrada' => 'Fecha y hora de entrada',
        'form.fecha_hora_salida' => 'Fecha y hora de salida',
    ];

    public function createAsistencia()
    {
        $this->resetInputFields();
        $this->toggleModal();
    }

    public function toggleModal()
    {
        $this->isOpen = !$this->isOpen;
    }

    public function resetInputFields()
    {
        $this->reset('form');
        $this->resetErrorBag();
    }

    public function save()
    {
        $this->form['empleado_id'] = $this->empleado->id;
        $this->form['cantidad_horas'] = Date::parse($this->form['fecha_hora_salida'])->diffInMinutes($this->form['fecha_hora_entrada']) / 60;
        $this->validate();
        Asistencia::create($this->form);
        $this->resetInputFields();
        $this->toggleModal();
        $this->emitTo('empleados.asistencias.index-asistencia', 'render');
        $this->emit('success', '¬°Asistencia agregada exitosamente!');
    }
}
