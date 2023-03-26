<?php

namespace App\Http\Livewire\Config;

use App\Models\Admin\Estados as AdminEstados;
use Livewire\Component;
use Livewire\WithPagination;

class Estados extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $prefijo, $nombre, $rol, $editId, $buscar, $icono, $color, $activo; 

    public function render()
    {
        $consulta = AdminEstados::paginate(10);
        return view('livewire.config.estados', compact('consulta'));
    }

    public function store()
    {
        $this->validate([
            'nombre' =>['required'],
        ]);
        if($this->icono == null) {
            $this->icono = "No asignado";
        }else{ 
            $partes = explode('"', $this->icono);
            $this->icono = $partes[0].'"'.$partes[1].' '.'fa-xl'.'"'.' '.'style="color:'.$this->color.';"'.$partes[2]; 
        }
        $consulta = AdminEstados::create([
            'nombre' =>  $this->nombre,
            'icono' => $this->icono,
            'activo' =>true
        ]);


        if ($consulta) {
            $this->dispatchBrowserEvent('GuardarCambios', ['mensaje'=>'¡Se ha creado el estado de manera satisfactoria!', 'id' => 'cerrarEstado' ]);
        }
    }

    public function resetIput()
    {
        $this->editId = null;
        $this->nombre = null;
        $this->icono = null;

    }

    public function edit($id)
    {
        $consulta = AdminEstados::find($id);
        $this->editId = $consulta->id;
        $this->nombre = $consulta->nombre;
        $this->icono = stripslashes($consulta->icono);
        $this->activo = $consulta->activo;
    }

    public function save()
    {
        if ($this->editId != null) {
            $this->update();
        } else {
            $this->store();
        }
    }

    public function update()
    {
        $consulta = AdminEstados::find($this->editId);
        if($this->icono == null){
            $this->icono = "No Asignado";
        }else{
            if($this->color !=null){
                if(strpos($this->icono, '#') == false){
                    if(strpos($this->icono, 'style="color:') == false){
                        $partes = explode('"', $this->icono);
                        $this->icono = $partes[0].'"'.$partes[1].' '.'fa-xl'.'"'.' '.'style="color:'.$this->color.';"'.$partes[2]; 
                    }else{
                        $partes = explode('color:', $this->icono);
                        $this->icono=$partes[0].'color:'.$this->color.$partes[1];
                    }
                }else{
                    $partes = explode('"', $this->icono);
                    $this->icono=$partes[0].'"'.$partes[1].'"'.$partes[2].'"color:'.$this->color.';"'.$partes[4];
                }
            }

            if(strpos($this->icono, 'fa-xl') == false){
                $partes = explode('"', $this->icono);
                if(strpos($this->icono, 'style="color:') == true){
                    $this->icono= $partes[0].'"'.$partes[1].' '.'fa-xl'.'"'.$partes[2].'"'.$partes[3].'"'.$partes[4];
                }else{
                    $this->icono= $partes[0].'"'.$partes[1].' '.'fa-xl'.'"'.$partes[2];
                }
            }
            // dd($partes);
        }
        $consulta->update([
            'nombre' => $this->nombre,
            'icono' => $this->icono,
            'activo' => $this->activo
        ]);

        if ($consulta) {
            $this->dispatchBrowserEvent('GuardarCambios', ['mensaje'=>'¡Se ha actualizado el estado de manera satisfactoria!', 'id' => 'cerrarEstado' ]);
            $this->resetIput();
        }
    }

    public function delete($id)
    {
        $consulta = AdminEstados::find($id);
        $consulta->activo = false;
        $consulta->save();
    }
}
