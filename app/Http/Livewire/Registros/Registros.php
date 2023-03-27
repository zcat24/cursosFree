<?php

namespace App\Http\Livewire\Registros;

use App\Models\Admin\Cursos;
use App\Models\Admin\TiposDocumentos;
use Livewire\Component;

class Registros extends Component
{
    public $cursoId;

    public function mount($id)
    {
        $this->cursoId = $id;
    }

    public function render()
    {
        $consultaTipoDocto = TiposDocumentos::all();
        $consultaCursos = Cursos::where('activo', true)->get();
        return view('livewire.registros.registros', compact('consultaTipoDocto', 'consultaCursos'));
    }
}
