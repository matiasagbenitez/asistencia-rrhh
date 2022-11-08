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
        'nombre' => '',
        'descripcion' => '',
        'fecha_hora' => '',
        'descontar' => '',
        'empleado_id' => '',
        'tipo_de_incidencia_id' => '',
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
        'form.nombre' => 'required',
        'form.descripcion' => 'required',
        'form.fecha_hora' => 'required',
        'form.descontar' => 'required',
        'form.empleado_id' => 'required',
        'form.tipo_de_incidencia_id' => 'required',
    ];

    protected $validationAttributes = [
        'form.nombre' => 'Nombre',
        'form.descripcion' => 'Descripción',
        'form.fecha_hora' => 'Fecha y hora',
        'form.descontar' => 'Descontar',
        'form.empleado_id' => 'Empleado',
        'form.tipo_de_incidencia_id' => 'Tipo de incidencia',
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
