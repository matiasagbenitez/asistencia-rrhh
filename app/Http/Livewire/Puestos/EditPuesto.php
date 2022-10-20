<?php

namespace App\Http\Livewire\Puestos;

use App\Models\Area;
use App\Models\Puesto;
use Livewire\Component;
use App\Models\Departamento;

class EditPuesto extends Component
{
    public $isOpen = 0;
    public $areas = [], $departamentos = [];
    public $puesto, $puesto_id, $departamento_id, $area_id;

    public $editForm = [
        'area_id' => '',
        'departamento_id' => '',
        'nombre' => '',
    ];

    protected $validationAttributes = [
        'editForm.area_id' => 'area',
        'editForm.departamento_id' => 'departamento',
        'editForm.nombre' => 'nombre',
    ];

    public function mount(Puesto $puesto)
    {
        $this->puesto = $puesto;
        $this->puesto_id = $puesto->id;
        $this->editForm['area_id'] = $puesto->departamento->area_id;
        $this->editForm['departamento_id'] = $puesto->departamento_id;
        $this->editForm['nombre'] = $puesto->nombre;
        $this->areas = Area::all();
        $this->updatedEditFormAreaId($this->editForm['area_id']);
    }

    public function editPuesto()
    {
        $this->resetInputFields();
        $this->toggleModal();
        $this->editForm['area_id'] = $this->puesto->departamento->area_id;
        $this->editForm['departamento_id'] = $this->puesto->departamento_id;
        $this->editForm['nombre'] = $this->puesto->nombre;
    }

    public function toggleModal()
    {
        $this->isOpen = !$this->isOpen;
    }

    public function resetInputFields()
    {
        $this->reset('editForm');
        $this->resetErrorBag();
    }

    public function updatedEditFormAreaId($value)
    {
        $this->departamentos = Departamento::where('area_id', $value)->get();
    }

    public function update()
    {
        $this->validate([
            'editForm.departamento_id' => 'required|exists:departamentos,id',
            'editForm.nombre' => 'required|unique:puestos,nombre,' . $this->puesto_id . ',id,departamento_id,' . $this->editForm['departamento_id'],
        ]);

        $this->puesto->update([
            'departamento_id' => $this->editForm['departamento_id'],
            'nombre' => $this->editForm['nombre'],
        ]);

        $this->reset('editForm');
        $this->toggleModal();
        $this->emit('success', '¡Puesto actualizado con éxito!');
        $this->emitTo('puestos.index-puestos', 'render');
    }

    public function render()
    {
        return view('livewire.puestos.edit-puesto');
    }
}
