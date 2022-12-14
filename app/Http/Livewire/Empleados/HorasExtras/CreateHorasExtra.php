<?php

namespace App\Http\Livewire\Empleados\HorasExtras;

use App\Models\HoraExtra;
use Livewire\Component;

class CreateHorasExtra extends Component
{
    public $isOpen = 0;
    public $collections;

    public $form = [
        'fecha_hora_inicio' => '',
        'fecha_hora_fin' => '',
        'cantidad_horas' => '-',
        'empleado_id' => '',
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
        'form.fecha_hora_inicio' => 'required|before:form.fecha_hora_fin',
        'form.fecha_hora_fin' => 'required|after:form.fecha_hora_inicio',
        'form.cantidad_horas' => 'required',
        'form.empleado_id' => 'required',
    ];

    protected $validationAttributes = [
        'form.fecha_hora_inicio' => 'fecha y hora de inicio',
        'form.fecha_hora_fin' => 'fecha y hora de fin',
        'form.cantidad_horas' => 'cantidad de horas',
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

    public function updatedFormFechaHoraFin()
    {
        if ($this->form['fecha_hora_inicio'] && $this->form['fecha_hora_fin']) {
            // Validar que la fecha de inicio sea menor a la fecha de fin
            $this->validate([
                'form.fecha_hora_inicio' => 'before:form.fecha_hora_fin',
                'form.fecha_hora_fin' => 'after:form.fecha_hora_inicio',
            ]);

            $hora_inicio = strtotime($this->form['fecha_hora_inicio']);
            $hora_fin = strtotime($this->form['fecha_hora_fin']);
            $this->form['cantidad_horas'] = round(abs($hora_fin - $hora_inicio) / 3600, 2);
        } else {
            $this->form['cantidad_horas'] = '-';
        }
    }

    public function save()
    {
        $this->form['empleado_id'] = $this->empleado->id;
        $this->validate();
        HoraExtra::create($this->form);
        $this->resetInputFields();
        $this->toggleModal();
        $this->emitTo('empleados.horas-extras.index-horas-extra', 'render');
        $this->emit('success', '??Horas extras agregadas exitosamente!');
    }
}
