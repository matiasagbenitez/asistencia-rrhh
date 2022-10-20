<?php

namespace App\Http\Livewire\Empresas;

use Livewire\Component;

class EditarEmpresa extends Component
{
    public $isOpen = 0;

    public $empresa;

    public $editForm = [
        'nombre' => '',
        'cuit' => '',
        'razon_social' => '',
        'direccion' => '',
    ];

    protected $validationAttributes = [
        'editForm.nombre' => 'nombre',
        'editForm.cuit' => 'CUIT',
        'editForm.razon_social' => 'razón social',
        'editForm.direccion' => 'dirección',
    ];

    public function mount($empresa)
    {
        $this->empresa = $empresa;
    }

    public function edit()
    {
        $this->toggleModal();
        $this->resetInputFields();
        $this->editForm = [
            'nombre' => $this->empresa->nombre,
            'cuit' => $this->empresa->cuit,
            'razon_social' => $this->empresa->razon_social,
            'direccion' => $this->empresa->direccion,
        ];
    }

    public function toggleModal()
    {
        if ($this->isOpen == 1) {
            $this->isOpen = 0;
        } else {
            $this->isOpen = 1;
        }
    }

    public function resetInputFields()
    {
        $this->reset('editForm');
        $this->resetErrorBag();
    }

    public function update()
    {
        $this->validate([
            'editForm.nombre' => 'required',
            'editForm.cuit' => 'required',
            'editForm.razon_social' => 'required',
            'editForm.direccion' => 'required',
        ]);

        $this->empresa->update($this->editForm);

        $this->toggleModal();
        $this->emit('success', '¡Los datos de la empresa se han actualizado con éxito!');
        $this->emitTo('empresas.index-empresas', 'render');
    }

    public function render()
    {
        return view('livewire.empresas.editar-empresa');
    }
}
