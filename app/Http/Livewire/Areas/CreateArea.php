<?php

namespace App\Http\Livewire\Areas;

use App\Models\Area;
use App\Models\Empresa;
use Livewire\Component;

class CreateArea extends Component
{
    public $isOpen = 0;

    public $createForm = [
        'empresa_id' => '',
        'nombre' => '',
    ];

    protected $rules = [
        'createForm.empresa_id' => 'required|exists:empresas,id',
        'createForm.nombre' => 'required|unique:areas,nombre',
    ];

    protected $validationAttributes = [
        'createForm.empresa_id' => 'empresa',
        'createForm.nombre' => 'nombre',
    ];

    public function createArea()
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
        $this->reset('createForm');
        $this->resetErrorBag();
    }

    public function save()
    {
        $this->validate();
        Area::create($this->createForm);
        $this->emit('render');
        $this->emit('success', '¡El área se creó correctamente!');
        $this->toggleModal();
    }

    public function render()
    {
        $empresas = Empresa::all();
        return view('livewire.areas.create-area', compact('empresas'));
    }
}
