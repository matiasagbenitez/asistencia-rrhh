<?php

namespace App\Http\Livewire\Empleados\HorasExtras;

use App\Models\HoraExtra;
use Livewire\Component;

class CreateHorasExtra extends Component
{
    public $isOpen = 0;
    public $collections;

    public $form = [
        'form.fecha_hora_inicio' => '',
        'form.fecha_hora_fin' => '',
        'form.remuneracion' => '',
        'form.empleado_id' => '',
    ];

    public function mount($empleado)
    {
        $this->empleado = $empleado;
    }

    public function render()
    {
        return view('livewire.empleados.horas-extras.create-horas-extra');
    }

    protected $rules = [
        'form.fecha_hora_inicio' => 'required',
        'form.fecha_hora_fin' => 'required',
        'form.remuneracion' => 'required',
        'form.empleado_id' => 'required',
    ];

    protected $validationAttributes = [
        'form.fecha_hora_inicio' => 'Fecha y hora de inicio',
        'form.fecha_hora_fin' => 'Fecha y hora de fin',
        'form.remuneracion' => 'Remuneración',
    ];

    public function createHoraExtra()
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
        $this->validate();
        HoraExtra::create($this->form);
        $this->resetInputFields();
        $this->toggleModal();
        $this->emitTo('empleados.horas-extras.index-horas-extra', 'render');
        $this->emit('success', '¡Horas extras agregada exitosamente!');
    }
}
