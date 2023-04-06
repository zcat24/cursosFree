<?php

namespace App\Http\Livewire\Gestion;

use App\Models\Admin\Estados;
use App\Models\Gestion\RegistrosUsuarios;
use Livewire\Component;

class Estudiantes extends Component
{
    public $estudianteId, $estadoId;

    public function mount($id)
    {
        $this->estudianteId = $id;
    }

    public function render()
    {
        $consultaEstudiante = RegistrosUsuarios::find($this->estudianteId);
        // $this->estadoId = $consultaEstudiante->estado_id;
        $consultaEstados = Estados::where('activo', true)->get();
        return view('livewire.gestion.estudiantes', compact('consultaEstudiante', 'consultaEstados'));
    }

    public function cambioEstado()
    {
        if($this->estadoId){
            $consulta = RegistrosUsuarios::find($this->estudianteId)->update([
                'estado_id' => $this->estadoId
            ]);
            $this->dispatchBrowserEvent('guardarCambios');
        }
    }

    public function asignarmeCurso()
    {
        $consulta = RegistrosUsuarios::find($this->estudianteId)->update([
            'gestor_id' => auth()->user()->id
        ]);
        $this->dispatchBrowserEvent('autoAsignarme');
    }

}
