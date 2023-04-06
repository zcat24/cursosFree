<?php

namespace App\Http\Livewire\Config;

use App\Models\Admin\Categorias;
use App\Models\Admin\Cursos as AdminCursos;
use App\Models\Admin\users_categorias;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Cursos extends Component
{
    use WithFileUploads;

    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $editId, $categoria, $nombreCurso, $descripcion, $imagen, $creadorCurso, $activo;

    public function render()
    {
        if(auth()->user()->hasRole('Super Administrador')){
            $consulta = AdminCursos::paginate(5);
            $consultaCategoria = Categorias::all();
        }else{
            $consultaCatAsignadas = users_categorias::select('categoria_id')->where('user_id', auth()->user()->id)->get();
                $categorias=[];
                foreach($consultaCatAsignadas as $categoria){
                    array_push($categorias, $categoria->categoria_id);
                }
            $consulta = AdminCursos::whereIn('categoria_id', $categorias)->paginate(5);
            $consultaCategoria = Categorias::whereIn('id', $categorias)->get();
        }
        return view('livewire.config.cursos', compact('consulta', 'consultaCategoria'));
    }

    public function editar($id)
    {
        $this->editId = $id;
        $consulta = AdminCursos::find($this->editId);
        $this->categoria = $consulta->categoria_id;
        $this->nombreCurso = ucfirst($consulta->nombre);
        $this->descripcion = ucfirst($consulta->descripcion);
        if($consulta->creador_id){
            $this->creadorCurso = ucwords($consulta->creador->nombres);
        }else{
            $this->creadorCurso = 'Administrativo';
        }
        $this->activo = $consulta->activo;

    }

    public function save()
    {
        if($this->editId == null){
            $this->guardarCurso();
        }else{
            $this->editarCurso();
        }
    }

    public function guardarCurso()
    {
        $rules = [
            'categoria' => 'required',
            'nombreCurso' => 'required',
            'descripcion' => 'required'
        ];

        $messages = [
            'categoria.required' => '¡Seleccione la categoria!',
            'nombreCurso.required' => '¡Digite un nombre!',
            'descripcion.required' => '¡Digite una descripcion!',
        ];

        $this->validate($rules, $messages);

        if($this->imagen){
            $path = $this->imagen->storeAs('imagenesCursos', $this->nombreCurso.'.'.$this->imagen->getClientOriginalExtension(), $disk='public');
        }else{
            $path= null;
        }

        $consulta = AdminCursos::create([
            'categoria_id' => $this->categoria,
            'nombre' =>  $this->nombreCurso,
            'descripcion' => $this->descripcion,
            'imagen' => $path,
            'creador_id' => auth()->user()->id,
            'activo' => true
        ]);

        if ($consulta){
            $this->reset([]);
            $this->dispatchBrowserEvent('GuardarCambios', ['mensaje'=>'Se ha creado el curso manera satisfactoria', 'id'=>'cerrarcurso']);
        }
    }

    public function editarCurso()
    {
        $rules = [
            'categoria' => 'required',
            'nombreCurso' => 'required',
            'descripcion' => 'required'
        ];

        $messages = [
            'categoria.required' => '¡Seleccione la categoria!',
            'nombreCurso.required' => '¡Digite un nombre!',
            'descripcion.required' => '¡Digite una descripcion!',
        ];

        $this->validate($rules, $messages);

        if($this->imagen){
            $path = $this->imagen->storeAs('imagenesCursos', $this->nombreCurso.'.'.$this->imagen->getClientOriginalExtension(), $disk='public');
            $consulta = AdminCursos::find($this->editId)->update([
                'categoria_id' => $this->categoria,
                'nombre' => $this->nombreCurso,
                'descripcion' => $this->descripcion,
                'imagen' => $path,
                'activo' => $this->activo
            ]);
        }else{
            $path = null;
            $consulta = AdminCursos::find($this->editId)->update([
                'categoria_id' => $this->categoria,
                'nombre' => $this->nombreCurso,
                'descripcion' => $this->descripcion,
                'activo' => $this->activo
            ]);
        }
        if ($consulta){
            $this->reset([]);
            $this->dispatchBrowserEvent('GuardarCambios', ['mensaje'=>'Se ha actualizado el curso de manera satisfactoria', 'id'=>'cerrarcurso']);
        }
        
    }

    public function limpiar()
    {
        $this->reset(['activo']);
    }
}
