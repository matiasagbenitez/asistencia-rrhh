<?php

namespace App\Http\Livewire\Areas;

use App\Models\Area;
use App\Models\Empresa;
use Livewire\Component;

class EditArea extends Component
{
    public $isOpen = 0;

    public $area, $area_id;

    public $editForm = [
        'empresa_id' => '',
        'nombre' => '',
    ];

    protected $validationAttributes = [
        'editForm.empresa_id' => 'empresa',
        'editForm.nombre' => 'nombre',
    ];

    public function mount(Area $area)
    {
        $this->area = $area;
        $this->area_id = $area->id;
        $this->editForm = [
            'empresa_id' => $area->empresa_id,
            'nombre' => $area->nombre,
        ];
    }

    public function editArea()
    {
        $this->resetInputFields();
        $this->toggleModal();
        $this->editForm = [
            'empresa_id' => $this->area->empresa_id,
            'nombre' => $this->area->nombre,
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
            'editForm.empresa_id' => 'required|exists:empresas,id',
            'editForm.nombre' => 'required|unique:areas,nombre,' . $this->area_id,
        ]);
        $this->area->update($this->editForm);
        $this->emit('render');
        $this->emit('success', '¡El área se actualizó correctamente!');
        $this->toggleModal();
    }

    public function render()
    {
        $empresas = Empresa::all();
        return view('livewire.areas.edit-area', compact('empresas'));
    }
}
