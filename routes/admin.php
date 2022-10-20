<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Areas\IndexAreas;
use App\Http\Livewire\Puestos\IndexPuestos;
use App\Http\Livewire\Empresas\IndexEmpresas;
use App\Http\Livewire\Departamentos\IndexDepartamentos;

// PARÁMETROS DE EMPRESA
Route::get('/empresas', IndexEmpresas::class)->name('empresas.index');
Route::get('/areas', IndexAreas::class)->name('areas.index');
Route::get('/departamentos', IndexDepartamentos::class)->name('departamentos.index');
Route::get('/puestos', IndexPuestos::class)->name('puestos.index');
