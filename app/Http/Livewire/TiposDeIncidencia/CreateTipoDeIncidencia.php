<?php

namespace App\Http\Livewire\TiposDeIncidencia;

use Livewire\Component;
use App\Models\TipoDeIncidencia;

class CreateTipoDeIncidencia extends Component
{
    public $isOpen = 0;

    public $form = [
        'nombre' => '',
        'descuenta_sueldo' => 1,
    ];

    public function render()
    {
        return view('livewire.tipos-de-incidencia.create-tipo-de-incidencia');
    }

    protected $rules = [
        'form.nombre' => 'required|unique:tipos_de_incidencia,nombre',
        'form.descuenta_sueldo' => 'required|boolean',
    ];

    protected $validationAttributes = [
        'form.nombre' => 'nombre',
        'form.descuenta_sueldo' => 'descuenta sueldo',
    ];

    public function createTipoDeIncidencia()
    {
        $this->resetInputFields();
        $this->toggleModal();
    }

    public function toggleModal()
    {
        $this->isOpen = !$this->isOpen;
    }

    private function resetInputFields()
    {
        $this->reset('form');
        $this->resetErrorBag();
    }

    public function save()
    {
        $this->validate();
        TipoDeIncidencia::create($this->form);
        $this->toggleModal();
        $this->emitTo('tipos-de-incidencia.index-tipos-de-incidencia', 'render');
        $this->emit('success', '¡El tipo de incidencia se ha creado correctamente!');
    }
}
