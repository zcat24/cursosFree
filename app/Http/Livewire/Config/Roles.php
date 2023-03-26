<?php

namespace App\Http\Livewire\Config;

use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class Roles extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $editId, $nombre;

    public function render()
    {
        $consulta = Role::paginate(10);
        $consultaPermisos = Permission::all();
        return view('livewire.config.roles', compact('consulta', 'consultaPermisos'));
    }

    public function save()
    {
        if($this->editId == null){
            $this->guardarRol();
        }else{
            $this->editarRol();
        }
    }

    public function editar($id)
    {
        $this->editId = $id;
        $consulta = Role::find($this->editId);
        $this->nombre = ucfirst($consulta->name);
    }

    public function guardarRol()
    {
        $rules = [
            'nombre' => 'required',
        ];

        $messages = [
            'nombre.required' => '¡Digite un nombre!',
        ];

        $this->validate($rules, $messages);

        $consulta = Role::create([
            'name' => $this->nombre,
        ]);

        if ($consulta){
            $this->dispatchBrowserEvent('GuardarCambios', ['mensaje'=>'Se ha creado el Rol de manera satisfactoria', 'id'=>'cerrar']);
        }
    }

    public function editarRol()
    {
        $consulta = Role::find($this->editId);
        $consulta->name = $this->nombre;
        if ($consulta->isDirty()){
            $consulta->save();
            // $this->reset(['nombre','editId' ]);
            $this->dispatchBrowserEvent('GuardarCambios', ['mensaje'=>'Se ha actualizado el Rol de manera satisfactoria','id'=>'cerrar']);
        }
    }

    public function limpiar()
    {
        $this->reset(['nombre', 'editId' ]);
    }

    public function asignarPermiso($id)
    {
        $role = Role::findById($this->editId);
        if($role->hasPermissionTo($id)){
            $role->revokePermissionTo($id);
            session()->flash('eliminarPermiso', '¡Se ha eliminado el permiso del rol');
        }else{
            $role->givePermissionTo($id);
            session()->flash('asignarPermiso', '¡Se ha asignado el permiso al rol');
        }
    }

    public function validarPermiso($rol,$permiso)
    {
        if($rol){
            $role = Role::findById($rol);
            if($role->hasPermissionTo($permiso)){
                return 'checked';
            }else{
                return '';
            }
        }
    }
}
