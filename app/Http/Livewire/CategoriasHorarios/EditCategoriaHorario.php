<?php

namespace App\Http\Livewire\CategoriasHorarios;

use App\Models\CategoriasDeHorarios;
use Livewire\Component;

class EditCategoriaHorario extends Component
{
    public $isOpen = 0;

    public $categoriaHorario, $categoriaHorario_id;

    public $editForm = [
        'nombre' => '',
    ];

    protected $validationAttributes = [
        'editForm.nombre' => 'nombre',
    ];

    public function mount(CategoriasDeHorarios $categoria_de_horario)
    {
        $this->categoriaHorario = $categoria_de_horario;
        $this->categoriaHorario_id = $categoria_de_horario->id;
        $this->editForm = [
            'nombre' => $categoria_de_horario->nombre,
        ];
    }

    public function editCategoriaHorario()
    {
        $this->resetInputFields();
        $this->toggleModal();
        $this->editForm = [
            'nombre' => $this->categoriaHorario->nombre,
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
            'editForm.nombre' => 'required|unique:categorias_de_horarios,nombre,' . $this->categoriaHorario_id,
        ]);

        $this->categoriaHorario->update($this->editForm);

        $this->emit('render');
        $this->emit('success', '¡Categoría de horario actualizada con éxito!');
        $this->toggleModal();
    }

    public function render()
    {
        return view('livewire.categorias-horarios.edit-categoria-horario');
    }
}
