<?php

namespace App\Http\Livewire\Departamentos;

use App\Models\Area;
use Livewire\Component;
use App\Models\Departamento;

class CreateDepartamento extends Component
{
    public $isOpen = 0;

    public $createForm = [
        'area_id' => '',
        'nombre' => '',
    ];

    protected $validationAttributes = [
        'createForm.area_id' => 'área',
        'createForm.nombre' => 'nombre',
    ];

    public function createDepartamento()
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
        $this->validate([
            'createForm.area_id' => 'required|exists:areas,id',
            'createForm.nombre' => 'required|unique:departamentos,nombre,NULL,id,area_id,' . $this->createForm['area_id'],
        ]);
        Departamento::create($this->createForm);
        $this->emit('render');
        $this->emit('success', '¡El departamento se creó correctamente!');
        $this->toggleModal();
    }

    public function render()
    {
        $areas = Area::orderBy('id')->get();
        return view('livewire.departamentos.create-departamento', compact('areas'));
    }
}
