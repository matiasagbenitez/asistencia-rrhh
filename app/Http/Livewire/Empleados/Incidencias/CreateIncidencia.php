<?php

namespace App\Http\Livewire\Empleados\Incidencias;

use Livewire\Component;
use App\Models\Incidencia;
use App\Models\TipoDeIncidencia;

class CreateIncidencia extends Component
{
    public $isOpen = 0;
    public $collections;

    public $form = [
        'empleado_id' => '',
        'tipo_de_incidencia_id' => '',
        'fecha_hora_inicio' => '',
        'fecha_hora_fin' => '',
        'descripcion' => '',
    ];

    public function mount($empleado)
    {
        $this->empleado = $empleado;
    }

    public function render()
    {
        return view('livewire.empleados.incidencias.create-incidencia', [
            'tipos_de_incidencia' => TipoDeIncidencia::all(),
        ]);
    }

    protected $rules = [
        'form.empleado_id' => 'required',
        'form.tipo_de_incidencia_id' => 'required',
        'form.fecha_hora_inicio' => 'required',
        'form.fecha_hora_fin' => 'nullable|after:form.fecha_hora_inicio',
        'form.descripcion' => 'nullable',
    ];

    protected $validationAttributes = [
        'form.empleado_id' => 'empleado',
        'form.tipo_de_incidencia_id' => 'tipo de incidencia',
        'form.fecha_hora_inicio' => 'fecha y hora de inicio',
        'form.fecha_hora_fin' => 'fecha y hora de inicio',
        'form.descripcion' => 'descripción',
    ];

    public function createIncidencia()
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
        Incidencia::create($this->form);
        $this->resetInputFields();
        $this->toggleModal();
        $this->emitTo('empleados.incidencias.index-incidencia', 'render');
        $this->emit('success', '¡Incidencia agregada exitosamente!');
    }
}
