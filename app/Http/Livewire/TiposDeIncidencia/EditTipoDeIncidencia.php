<?php

namespace App\Http\Livewire\TiposDeIncidencia;

use Livewire\Component;
use App\Models\TipoDeIncidencia;

class EditTipoDeIncidencia extends Component
{
    public $isOpen = 0;
    public $tipo_de_incidencia;

    public function mount(TipoDeIncidencia $tipo)
    {
        $this->tipo_de_incidencia = $tipo;
    }

    public function render()
    {
        return view('livewire.tipos-de-incidencia.edit-tipo-de-incidencia');
    }

    public $form = [
        'nombre' => '',
    ];

    protected $validationAttributes = [
        'form.nombre' => 'nombre',
    ];

    public function editTipoDeIncidencia()
    {
        $this->toggleModal();
        $this->form = [
            'nombre' => $this->tipo_de_incidencia->nombre,
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
            'form.nombre' => 'required|unique:tipos_de_incidencia,nombre,' . $this->tipo_de_incidencia->id,
        ]);
        $this->tipo_de_incidencia->update($this->form);
        $this->toggleModal();
        $this->emitTo('tipos-de-incidencia.index-tipos-de-incidencia', 'render');
        $this->emit('success', '¡El tipo de incidencia se ha actualizado correctamente!');
    }
}
