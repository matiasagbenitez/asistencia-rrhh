<?php

namespace App\Http\Livewire\Empleados\HorasExtras;

use App\Models\HoraExtra;
use Livewire\Component;

class EditHorasExtra extends Component
{
    public $isOpen = 0;
    public $horasExtra;

    public function mount(HoraExtra $horasExtra)
    {
        $this->horasExtra = $horasExtra;
    }

    public function render()
    {
        return view('livewire.empleados.horas-extras.edit-horas-extra');
    }

    public $form = [
        'form.fecha_hora_inicio' => '',
        'form.fecha_hora_fin' => '',
        'form.remuneracion' => '',
        'form.empleado_id' => '',
    ];

    protected $validationAttributes = [
        'form.fecha_hora_inicio' => 'Fecha y hora de inicio',
        'form.fecha_hora_fin' => 'Fecha y hora de fin',
        'form.remuneracion' => 'Remuneración',
    ];

    public function editHorasExtra()
    {
        $this->toggleModal();
        $this->form = [
            'fecha_hora_inicio' => $this->horasExtra->fecha_hora_inicio,
            'fecha_hora_fin' => $this->horasExtra->fecha_hora_fin,
            'remuneracion' => $this->horasExtra->remuneracion,
            'empleado_id' => $this->horasExtra->empleado_id,
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
            'form.fecha_hora_inicio' => 'required',
            'form.fecha_hora_fin' => 'required',
            'form.remuneracion' => 'required',
            'form.empleado_id' => 'required',
        ]);
        $this->horasExtra->update($this->form);
        $this->toggleModal();
        $this->emitTo('empleados.horas-extras.index-horas-extra', 'render');
        $this->emit('success', '¡La hora extra se actualizó correctamente!');
    }
}
