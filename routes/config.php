<?php

use App\Http\Livewire\Config\Categorias;
use App\Http\Livewire\Config\Cursos;
use App\Http\Livewire\Config\Estados;
use App\Http\Livewire\Config\Permisos;
use App\Http\Livewire\Config\Roles;
use App\Http\Livewire\Config\Usuarios;
use App\Http\Livewire\Gestion\Consultas;
use App\Http\Livewire\Gestion\Estudiantes;
use Illuminate\Support\Facades\Route;

Route::get('/user', Usuarios::class)->name('usuarios')->can('gestionar usuarios');
Route::get('/roles', Roles::class)->name('roles')->can('gestionar roles');
Route::get('/permisos', Permisos::class)->name('permisos')->can('gestionar permisos');
Route::get('/estados', Estados::class)->name('estados')->can('gestionar estados');
Route::get('/cursos', Cursos::class)->name('cursos')->can('gestionar curso');
Route::get('/categorias', Categorias::class)->name('categorias')->can('gestionar categorias');
Route::get('/estudiante/{id}', Estudiantes::class)->name('estudiantes');
Route::get('/consultas', Consultas::class)->name('consultas')->can('modulo de consultas');
