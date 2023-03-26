<?php

namespace App\Http\Livewire\Registros;

use App\Models\Admin\Cursos;
use Livewire\Component;
use Livewire\WithPagination;

class Welcome extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $consulta = Cursos::where('activo', true)->paginate(10);
        return view('livewire.registros.welcome', compact('consulta'));
    }
}
