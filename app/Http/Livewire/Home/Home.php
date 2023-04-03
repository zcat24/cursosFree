<?php

namespace App\Http\Livewire\Home;

use App\Models\User;
use Livewire\Component;

class Home extends Component
{
    public $gestrorId;

    public function render()
    {
        $gestores = User::where('activo', true)->get();
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
