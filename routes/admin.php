<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Empresas\IndexEmpresas;

Route::get('/empresas', IndexEmpresas::class)->name('empresas.index');
