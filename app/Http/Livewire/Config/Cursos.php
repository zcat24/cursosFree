<?php

namespace App\Http\Livewire\Config;

use App\Models\Admin\Cursos as AdminCursos;
use Livewire\Component;

class Cursos extends Component
{
    public $editId;

    public function render()
    {
        $consulta = AdminCursos::paginate(5);
        return view('livewire.config.cursos', compact('consulta'));
    }
}
