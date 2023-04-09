<?php

namespace App\Http\Livewire\Gestion;

use App\Exports\ConsultasCursos;
use App\Models\Admin\Categorias;
use App\Models\Admin\Cursos;
use App\Models\Admin\users_categorias;
use App\Models\Gestion\RegistrosUsuarios;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Consultas extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $tipoconsulta, $fechaDesde, $fechaHasta;

    public function render()
    {
        $consulta = $this->tipoConsulta();
        return view('livewire.gestion.consultas', compact('consulta'));
    }

    public function tipoConsulta()
    {
        switch ($this->tipoconsulta) {
            case 1:
                $consulta = Categorias::whereBetween('created_at', [$this->fechaDesde, $this->fechaHasta])
                                        ->paginate(10);
                return $consulta;
            break;

            case 2:
                $consulta = Cursos::whereBetween('created_at', [$this->fechaDesde, $this->fechaHasta])
                                    ->paginate(10);
                return $consulta;
            break;

            case 3:
                $consulta = RegistrosUsuarios::whereBetween('created_at', [$this->fechaDesde, $this->fechaHasta])
                                                ->paginate(10);
                return $consulta;
            break;

            case 4:
               $consulta = users_categorias::whereBetween('updated_at', [$this->fechaDesde, $this->fechaHasta])
                                ->paginate(10); 

                return $consulta;                  
            break;
        }
    }

    public function exportarConsulta()
    {
        return (new ConsultasCursos($this->tipoconsulta, $this->fechaDesde, $this->fechaHasta));
    }
}
