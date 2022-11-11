<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Areas\IndexAreas;
use App\Http\Livewire\Puestos\IndexPuestos;
use App\Http\Livewire\Empresas\IndexEmpresas;
use App\Http\Livewire\Empleados\IndexEmpleados;
use App\Http\Livewire\Departamentos\IndexDepartamentos;
use App\Http\Livewire\Empleados\HorasExtras\IndexHorasExtra;
use App\Http\Livewire\Empleados\Incidencias\IndexIncidencia;
use App\Http\Livewire\CategoriasHorarios\Jornadas\IndexJornada;
use App\Http\Livewire\TiposDeIncidencia\IndexTiposDeIncidencia;
use App\Http\Livewire\CategoriasHorarios\IndexCategoriasHorarios;
use App\Http\Livewire\Informe\IndexInforme;

// PARÁMETROS DE EMPRESA
Route::get('/empresas', IndexEmpresas::class)->name('empresas.index');
Route::get('/areas', IndexAreas::class)->name('areas.index');
Route::get('/departamentos', IndexDepartamentos::class)->name('departamentos.index');
Route::get('/puestos', IndexPuestos::class)->name('puestos.index');

// CATEGORIAS DE HORARIO
Route::get('/categorias-de-horario', IndexCategoriasHorarios::class)->name('categorias-de-horario.index');
Route::get('/categorias-de-horario/{categorias_de_horarios}/jornadas', IndexJornada::class)
    ->name('categorias-de-horario.jornada.index');

// EMPLEADOS
Route::get('/empleados', IndexEmpleados::class)->name('empleados.index');
Route::get('/empleados/{empleado}/incidencias', IndexIncidencia::class)->name('empleados.incidencias.index');
Route::get('/empleados/{empleado}/horas-extras', IndexHorasExtra::class)->name('empleados.horas-extras.index');

// TIPOS DE INCIDENCIAS
Route::get('/tipos-de-incidencia', IndexTiposDeIncidencia::class)->name('tipos-de-incidencias.index');

// INFOMRES
Route::get('/informes', IndexInforme::class)->name('informes.index');
