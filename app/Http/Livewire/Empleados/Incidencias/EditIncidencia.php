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
        'nombre' => '',
        'descripcion' => '',
        'fecha_hora' => '',
        'descontar' => '',
        'empleado_id' => '',
        'tipo_de_incidencia_id' => '',
    ];

    protected $validationAttributes = [
        'form.nombre' => 'Nombre',
        'form.descripcion' => 'Descripción',
        'form.fecha_hora' => 'Fecha y hora',
        'form.descontar' => 'Descontar',
        'form.empleado_id' => 'Empleado',
        'form.tipo_de_incidencia_id' => 'Tipo de incidencia',
    ];

    public function editIncidencia()
    {
        $this->toggleModal();
        $this->form = [
            'nombre' => $this->incidencia->nombre,
            'descripcion' => $this->incidencia->descripcion,
            'fecha_hora' => $this->incidencia->fecha_hora,
            'descontar' => $this->incidencia->descontar,
            'empleado_id' => $this->incidencia->empleado_id,
            'tipo_de_incidencia_id' => $this->incidencia->tipo_de_incidencia_id,
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
            'form.nombre' => 'required',
            'form.descripcion' => 'required',
            'form.fecha_hora' => 'required',
            'form.descontar' => 'required',
            'form.empleado_id' => 'required',
            'form.tipo_de_incidencia_id' => 'required',
        ]);
        $this->incidencia->update($this->form);
        $this->toggleModal();
        $this->emitTo('empleados.incidencias.index-incidencia', 'render');
        $this->emit('success', '¡La incidencia se actualizó correctamente!');
    }
}
