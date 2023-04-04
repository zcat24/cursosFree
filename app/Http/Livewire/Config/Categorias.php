<?php

namespace App\Http\Livewire\Config;

use App\Models\Admin\Categorias as AdminCategorias;
use Livewire\Component;

class Categorias extends Component
{
    public $editId, $prefijo, $nombre, $activo;

    public function render()
    {
        $consulta = AdminCategorias::paginate(10);
        return view('livewire.config.categorias', compact('consulta'));
    }

    public function edit($id)
    {
        $consulta = AdminCategorias::find($id);
        $this->editId = $consulta->id;
        $this->prefijo = $consulta->prefijo;
        $this->nombre = $consulta->nombre;
        $this->activo = $consulta->activo;
    }

    public function store()
    {
        $this->validate([
            'nombre' =>['required'],
        ]);
        $consulta = AdminCategorias::create([
            'prefijo' => $this->prefijo,
            'nombre' =>  ucfirst($this->nombre),
            'activo' => true
        ]);


        if ($consulta) {
            $this->dispatchBrowserEvent('GuardarCambios', ['mensaje'=>'¡Se ha creado el estado de manera satisfactoria!', 'id' => 'cerrarCategoria' ]);
            $this->reset([]);
        }
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
        $consulta = AdminCategorias::find($this->editId);
        $consulta->update([
            'prefijo' => $this->prefijo,
            'nombre' => $this->nombre,
            'activo' => $this->activo
        ]);

        if ($consulta) {
            $this->dispatchBrowserEvent('GuardarCambios', ['mensaje'=>'¡Se ha actualizado el estado de manera satisfactoria!', 'id' => 'cerrarCategoria' ]);
            $this->reset([]);
        }
    }
}
