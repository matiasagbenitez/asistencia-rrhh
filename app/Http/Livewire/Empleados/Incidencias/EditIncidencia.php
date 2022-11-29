<?php

namespace App\Http\Livewire\Empleados\Incidencias;

use Livewire\Component;
use App\Models\Incidencia;
use App\Models\TipoDeIncidencia;

class EditIncidencia extends Component
{
    public $isOpen = 0;
    public $incidencia;

    public function mount(Incidencia $incidencia)
    {
        $this->incidencia = $incidencia;
    }

    public function render()
    {
        return view('livewire.empleados.incidencias.edit-incidencia', [
            'tipos_de_incidencia' => TipoDeIncidencia::all(),
        ]);
    }

    public $form = [
        'empleado_id' => '',
        'tipo_de_incidencia_id' => '',
        'fecha_hora_inicio' => '',
        'fecha_hora_fin' => '',
        'descripcion' => '',
    ];

    protected $validationAttributes = [
        'form.empleado_id' => 'empleado',
        'form.tipo_de_incidencia_id' => 'tipo de incidencia',
        'form.fecha_hora_inicio' => 'fecha y hora de inicio',
        'form.fecha_hora_fin' => 'fecha y hora de inicio',
        'form.descripcion' => 'descripción',
    ];

    public function editIncidencia()
    {
        $this->toggleModal();
        $this->form = [
            'tipo_de_incidencia_id' => $this->incidencia->tipo_de_incidencia_id,
            'fecha_hora_inicio' => $this->incidencia->fecha_hora_inicio,
            'fecha_hora_fin' => $this->incidencia->fecha_hora_fin,
            'empleado_id' => $this->incidencia->empleado_id,
            'descripcion' => $this->incidencia->descripcion,
        ];
    }

    public function toggleModal()
    {
        $this->isOpen = !$this->isOpen;
        $this->resetErrorBag();
    }

    public function update()
    {
        if ($this->form['fecha_hora_fin'] == '') {
            $this->form['fecha_hora_fin'] = null;
        }

        $this->validate([
            'form.empleado_id' => 'required',
            'form.tipo_de_incidencia_id' => 'required',
            'form.fecha_hora_inicio' => 'required',
            'form.fecha_hora_fin' => 'nullable|after:form.fecha_hora_inicio',
            'form.descripcion' => 'nullable',
        ]);
        $this->incidencia->update($this->form);
        $this->toggleModal();
        $this->emitTo('empleados.incidencias.index-incidencia', 'render');
        $this->emit('success', '¡La incidencia se actualizó correctamente!');
    }
}
