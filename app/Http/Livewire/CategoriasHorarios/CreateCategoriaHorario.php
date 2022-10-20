<?php

namespace App\Http\Livewire\CategoriasHorarios;

use App\Models\CategoriasDeHorarios;
use Livewire\Component;

class CreateCategoriaHorario extends Component
{
    public $isOpen = 0;

    public $createForm = [
        'nombre' => '',
    ];

    protected $rules = [
        'createForm.nombre' => 'required|unique:categorias_de_horarios,nombre',
    ];

    protected $validationAttributes = [
        'createForm.nombre' => 'nombre',
    ];

    public function createCategoriaHorario()
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
        CategoriasDeHorarios::create($this->createForm);
        $this->emit('render');
        $this->emit('success', '¡La categoría de horario se creó correctamente!');
        $this->toggleModal();
    }

    public function render()
    {
        return view('livewire.categorias-horarios.create-categoria-horario');
    }
}
