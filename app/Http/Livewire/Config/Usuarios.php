<?php

namespace App\Http\Livewire\Config;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class Usuarios extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $editId, $asignarRolId;

    public $nombres, $username, $cedula, $fechaNacimiento, $email, $activo;

    public function render()
    {
        $consulta = User::paginate(10);
        $consultaRol = Role::all();
        return view('livewire.config.usuarios', compact('consulta', 'consultaRol'));
    }

    public function limpiar()
    {
        $this->reset(['editId', 'username', 'nombres', 'cedula', 'fechaNacimiento', 'email', 'asignarRolId' ]);  
    }

    // public function editarSede($id)
    // {
    //     $this->usuarioIdSede = $id;
    //     $consulta = User::find($this->usuarioIdSede);
    //     $this->nombres = $consulta->nombres;
    //     if($consulta->sede_id != null){
    //         $this->asignarSedeId = $consulta->sede_id;
    //     }
    // }

    // public function asignarSede()
    // {
    //     if($this->asignarSedeId == ""){
    //         $this->asignarSedeId = null;
    //     }
    //     $consulta = User::find($this->usuarioIdSede)->update([
    //         'sede_id' => $this->asignarSedeId,
    //     ]);
    //     if ($consulta){
    //         $this->dispatchBrowserEvent('GuardarCambios', ['mensaje'=>'Se ha asignado la sede satisfactoriamente', 'id'=>'cerrarsede']);
    //     }
    // }

    public function edit($id)
    {
        $this->editId = $id;
        $consulta = User::find($this->editId);
        $this->username = $consulta->username;
        $this->nombres = ucwords($consulta->nombres);
        $this->cedula = $consulta->cedula;
        $this->fechaNacimiento = $consulta->fecha_nacimiento;
        $this->email = $consulta->email;
        $this->activo = $consulta->activo;
    }

    public function restablecerPassword($id)
    {
        $usuario = User::find($id);
        $usuario->password = Hash::make($usuario->cedula);
        $usuario->save();
        $this->dispatchBrowserEvent('GuardarCambios', ['mensaje'=>'Se ha restablecido el password de '.ucwords($usuario->nombres).' de manera satisfactoria', 'id'=>'cerrar']);

    }

    public function save()
    {
        if($this->editId == null){
            $this->guardarUsuario();
        }else{
            $this->editarUsuario();
        }
    }

    public function guardarUsuario()
    {
        $rules = [
            'username' => 'required',
            'nombres' => 'required',
            'cedula' => 'required|numeric|unique:users',
            'fechaNacimiento' => 'before:2004-01-01',
            'email' => 'email'
        ];

        $messages = [
            'username.required' => '¡Digite un username!',
            'nombres.required' => 'Digite el nombre completo',
            'cedula.required' => 'Digite la cedula',
            'cedula.numeric' => 'la cedula debe ser numero',
            'cedula.unique' => '¡La cedula ya e enceuntra en el sistema!',
            'fechaNacimiento.before' => 'El usuario debe ser mayor de edad',
            'email.email' => 'El correo debe contener @'
        ];

        $this->validate($rules, $messages);

        $consulta = User::create([
            'username' => $this->username,
            'nombres' => $this->nombres,
            'cedula' => $this->cedula,
            'fecha_nacimiento' => $this->fechaNacimiento,
            'email' => $this->email, 
            'password' => Hash::make($this->cedula),
            'activo' => true
        ]);

        if ($consulta){
            $this->dispatchBrowserEvent('GuardarCambios', ['mensaje'=>'Se ha creado el usuario de manera satisfactoria', 'id'=>'cerrar']);
        }
    }

    public function editarUsuario()
    {
        $consulta = User::find($this->editId)->update([
            'username' => $this->username,
            'nombres' => $this->nombres,
            'cedula' => $this->cedula,
            'fecha_nacimiento' => $this->fechaNacimiento,
            'email' => $this->email, 
            'activo' => $this->activo
        ]);
        if ($consulta){
            $this->dispatchBrowserEvent('GuardarCambios', ['mensaje'=>'Se ha actualizado el usuario de manera satisfactoria', 'id'=>'cerrar']);
        }
    }

    public function editarRol($id)
    {
        if($id){
            $this->editId = $id;
            $user = User::with('roles')->find($this->editId);
            $this->nombres = ucwords($user->nombres);
            foreach($user->roles as $rol){
                $this->asignarRolId = $rol->id;
            }
        }
    }

    public function asignarRol()
    {
        $user = User::find($this->editId);
        $user->syncRoles([]);
        $user->save();
        if($this->asignarRolId){
            $role = Role::find($this->asignarRolId);
            $user->assignRole($role);
            $this->dispatchBrowserEvent('GuardarCambios', 
                            ['mensaje'=>'¡Se ha asignado el rol de '.ucfirst($role->name).' a '.ucwords($user->nombres), 
                            'id'=>'cerrarRol']);
        }else{
            $this->dispatchBrowserEvent('informacion', ['mensaje'=>'¡Usuario sin rol!', 'id'=>'cerrarRol', 'tipoMsj'=>'info']);
        }
    }
}
