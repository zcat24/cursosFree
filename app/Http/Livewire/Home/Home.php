<?php

namespace App\Http\Livewire\Home;

use App\Models\User;
use Livewire\Component;

class Home extends Component
{
    public $gestrorId;

    public function render()
    {
        if(auth()->user()->hasRole('Super Administrador')){
            $gestores = User::where('activo', true)->get();
        }elseif (auth()->user()->hasPermissionTo('auto-asignar cursos')){
            $gestores = User::where('id', auth()->user()->id)->get();
        }else{
            $gestores = [];
        }
        return view('livewire.home.home', compact('gestores'));
    }

    public function asignarGestor()
    {
        $this->emit('AsignarGestores', $this->gestrorId);
    }

    public function limpiar()
    {
        $this->reset([]);
    }
}
