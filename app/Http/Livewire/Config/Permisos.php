<?php

namespace App\Http\Livewire\Config;

use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Permission;

class Permisos extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $editId, $nombre;

    public function render()
    {
        $consulta = Permission::paginate(10);
        return view('livewire.config.permisos', compact('consulta'));
    }

    public function save()
    {
        if($this->editId == null){
            $this->guardarPermiso();
        }else{
            $this->editarPermiso();
        }
    }

    public function editar($id)
    {
        $this->editId = $id;
        $consulta = Permission::find($this->editId);
        $this->nombre = ucfirst($consulta->name);
    }

    public function guardarPermiso()
    {
        $rules = [
            'nombre' => 'required',
        ];

        $messages = [
            'nombre.required' => '¡Digite un nombre!',
        ];

        $this->validate($rules, $messages);

        $consulta = Permission::create([
            'name' => $this->nombre,
        ]);

        if ($consulta){
            $this->reset(['nombre', 'editId' ]);
            $this->dispatchBrowserEvent('GuardarCambios', ['mensaje'=>'Se ha creado el Permiso de manera satisfactoria', 'id'=>'cerrar']);
        }
    }

    public function editarPermiso()
    {
        $consulta = Permission::find($this->editId);
        $consulta->name = $this->nombre;
        if ($consulta->isDirty()){
            $consulta->save();
            $this->reset(['nombre','editId' ]);
            $this->dispatchBrowserEvent('GuardarCambios', ['mensaje'=>'Se ha actualizado el Rol de manera satisfactoria','id'=>'cerrar']);
        }
    }

    public function limpiar()
    {
        $this->reset(['nombre', 'editId' ]);
    }
}
