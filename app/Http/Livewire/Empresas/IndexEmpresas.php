<?php

namespace App\Http\Livewire\Empresas;

use App\Models\Empresa;
use Livewire\Component;

class IndexEmpresas extends Component
{
    protected $listeners = ['render'];

    public function render()
    {
        $empresas = Empresa::all();
        return view('livewire.empresas.index-empresas', compact('empresas'));
    }
}
