<?php

namespace App\Http\Livewire\Registros;

use App\Models\Admin\Cursos;
use App\Models\Admin\TiposDocumentos;
use App\Models\Gestion\RegistrosUsuarios;
use Livewire\Component;

class Registros extends Component
{
    public $cursoId;

    public $tipoDocumentoId, $numeroDocto, $nombres, $apellidos, $telefono, $correo;

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

    public function saveRegister()
    {
        $rules = [
            'tipoDocumentoId' => 'required',
            'numeroDocto' => 'required',
            'nombres' => 'required',
            'apellidos' => 'required',
            'telefono' => 'required',
            'correo' => 'email',
            'cursoId' => 'required'
        ];

        $messages = [
            'tipoDocumentoId.required' => '¡Seleccione tipo documento!',
            'numeroDocto.required' => '!Digite el numero de documento!',
            'nombres.required' => '¡Digite sus nombres!',
            'apellidos.required' => '¡Digite sus apellidos!',
            'telefono.required' => '¡Digite sus apellidos!',
            'correo.email' => 'El correo debe contener @',
            'cursoId.required' => '¡seleccione un curso'

        ];

        $this->validate($rules, $messages);

        if(RegistrosUsuarios::where('numero_documento',$this->numeroDocto)->where('curso_id', $this->cursoId)->exists()){
            Session::flash('duplicado', 'Actualmente usted ya se enceuntra registrado en este curso.');
        }else{
            $consulta = RegistrosUsuarios::create([
                'tipo_documento_id' => $this->tipoDocumentoId,
                'numero_documento' => $this->numeroDocto,
                'nombres' => $this->nombres,
                'apellidos' => $this->apellidos,
                'telefono' => $this->telefono,
                'email' => $this->correo,
                'curso_id' => $this->cursoId,
                'estado_id' => 1
            ]);
            if($consulta){
                $this->dispatchBrowserEvent('RegistroExito', ['mensaje'=>'Se realizado el registro del curso satisfatoriamente, pronto uno de nuestros asesores se podra en contacto con tigo']);
                $this->reset();
            }
        }

    }
}
