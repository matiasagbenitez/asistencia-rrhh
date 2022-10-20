<?php

namespace App\Http\Livewire\Puestos;

use App\Models\Area;
use App\Models\Puesto;
use Livewire\Component;
use App\Models\Departamento;

class CreatePuesto extends Component
{
    public $isOpen = 0;
    public $areas = [], $departamentos = [];

    public $createForm = [
        'area_id' => '',
        'departamento_id' => '',
        'nombre' => '',
    ];

    protected $rules = [
        'createForm.area_id' => 'required|exists:areas,id',
        'createForm.nombre' => 'required',
    ];

    protected $validationAttributes = [
        'createForm.area_id' => 'area',
        'createForm.departamento_id' => 'departamento',
        'createForm.nombre' => 'nombre',
    ];

    public function createPuesto()
    {
        $this->resetInputFields();
        $this->toggleModal();
        $this->areas = Area::all();
    }

    public function updatedCreateFormAreaId($value)
    {
        $this->departamentos = Departamento::where('area_id', $value)->get();
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
            'createForm.departamento_id' => 'required|exists:departamentos,id',
            'createForm.nombre' => 'required|unique:puestos,nombre,NULL,id,departamento_id,' . $this->createForm['departamento_id'],
        ]);

        Puesto::create([
            'nombre' => $this->createForm['nombre'],
            'departamento_id' => $this->createForm['departamento_id'],
        ]);

        $this->reset('createForm');
        $this->emit('success', '¡Puesto creado correctamente!');
        $this->emit('render');
        $this->toggleModal();
    }

    public function render()
    {
        return view('livewire.puestos.create-puesto');
    }
}
