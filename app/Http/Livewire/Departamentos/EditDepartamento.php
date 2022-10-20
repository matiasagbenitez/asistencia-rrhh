<?php

namespace App\Http\Livewire\Departamentos;

use App\Models\Area;
use Livewire\Component;
use App\Models\Departamento;

class EditDepartamento extends Component
{
    public $isOpen = 0;

    public $departamento, $departamento_id;

    public $editForm = [
        'area_id' => '',
        'nombre' => '',
    ];

    protected $validationAttributes = [
        'editForm.area_id' => 'área',
        'editForm.nombre' => 'nombre',
    ];

    public function mount(Departamento $departamento)
    {
        $this->departamento = $departamento;
        $this->departamento_id = $departamento->id;
        $this->editForm = [
            'area_id' => $departamento->area_id,
            'nombre' => $departamento->nombre,
        ];
    }

    public function editDepartamento()
    {
        $this->resetInputFields();
        $this->toggleModal();
        $this->editForm = [
            'area_id' => $this->departamento->area_id,
            'nombre' => $this->departamento->nombre,
        ];
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

    public function update()
    {
        $this->validate([
            'editForm.area_id' => 'required|exists:areas,id',
            'editForm.nombre' => 'required|unique:departamentos,nombre,' . $this->departamento_id,
        ]);
        $this->departamento->update($this->editForm);
        $this->emit('render');
        $this->emit('success', '¡El departamento se actualizó correctamente!');
        $this->toggleModal();
    }

    public function render()
    {
        $areas = Area::all();
        return view('livewire.departamentos.edit-departamento', compact('areas'));
    }
}
