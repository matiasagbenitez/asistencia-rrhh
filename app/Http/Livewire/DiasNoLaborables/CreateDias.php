<?php

namespace App\Http\Livewire\DiasNoLaborables;

use App\Models\DiaNoLaborable;
use Livewire\Component;

class CreateDias extends Component
{
    public $isOpen = 0;

    public $form = [
        'nombre' => '',
        'fecha' => '',
    ];

    protected $rules = [
        'form.fecha' => 'required',
        'form.nombre' => 'required',
    ];

    protected $validationAttributes = [
        'form.fecha' => 'fecha',
        'form.nombre' => 'nombre',
    ];

    public function createDia()
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
        $this->validate();
        DiaNoLaborable::create($this->form);
        $this->emitTo('dias-no-laborables.index-dias', 'render');
        $this->emit('success', '¡El día no laborable se cargó correctamente!');
        $this->toggleModal();
    }

    public function render()
    {
        return view('livewire.dias-no-laborables.create-dia');
    }
}
