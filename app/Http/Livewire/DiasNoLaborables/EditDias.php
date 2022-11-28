<?php

namespace App\Http\Livewire\DiasNoLaborables;

use App\Models\DiaNoLaborable;
use Livewire\Component;

class EditDias extends Component
{
    public $isOpen = 0;

    public $dia;
    public $dia_id;

    public $form = [
        'fecha_id' => '',
        'nombre' => '',
    ];

    protected $validationAttributes = [
        'form.fecha' => 'fecha',
        'form.nombre' => 'nombre',
    ];

    public function mount(DiaNoLaborable $dia)
    {
        $this->dia = $dia;
        $this->dia_id = $dia->id;
        $this->form = [
            'fecha' => $dia->fecha,
            'nombre' => $dia->nombre,
        ];
    }

    public function editDia()
    {
        $this->resetInputFields();
        $this->toggleModal();
        $this->form = [
            'fecha' => $this->dia->fecha,
            'nombre' => $this->dia->nombre,
        ];
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

    public function update()
    {
        $this->validate([
            'form.fecha'  => 'required',
            'form.nombre' => 'required',
        ]);
        $this->dia->update($this->form);
        $this->emit('render');
        $this->emit('success', '¡El día se actualizó correctamente!');
        $this->toggleModal();
    }

    public function render()
    {
        return view('livewire.dias-no-laborables.edit-dia');
    }
}
