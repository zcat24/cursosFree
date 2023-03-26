<?php

use App\Http\Livewire\Config\Estados;
use App\Http\Livewire\Config\Permisos;
use App\Http\Livewire\Config\Roles;
use App\Http\Livewire\Config\Usuarios;
use Illuminate\Support\Facades\Route;

Route::get('/user', Usuarios::class)->name('usuarios')->can('gestionar usuarios');
Route::get('/roles', Roles::class)->name('roles')->can('gestionar roles');
Route::get('/permisos', Permisos::class)->name('permisos')->can('gestionar permisos');
Route::get('/estados', Estados::class)->name('estados')->can('gestionar estados');
