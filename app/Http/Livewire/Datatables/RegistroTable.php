<?php

namespace App\Http\Livewire\Datatables;

use App\Models\Admin\users_categorias;
use App\Models\Gestion\RegistrosUsuarios;
use App\Models\User;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Illuminate\Database\Eloquent\Builder;


class RegistroTable extends DataTableComponent
{
    Protected $listeners = ['AsignarGestores' => 'asignarGestores'];

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setTableRowUrl(function($row){

            });
        $this->setSingleSortingDisabled();
        $this->setPerPageAccepted([1,2, 5, 10, 20, 30, -1]);
        if(auth()->user()->hasPermissionTo('ver todos estudiantes registrado') || auth()->user()->hasRole('Super Administrador')){
            $this->setBulkActions([
                'eliminarMasiva' => 'Eliminar',
                'asiganrGestor' => 'Asignar Gestor',
                'exportar' => 'Exportar'
            ]);
        }elseif(auth()->user()->hasPermissionTo('auto-asignar cursos') || auth()->user()->hasRole('Super Administrador')){
            $this->setBulkActions([
                'asiganrGestor' => 'Asignarme Cursos',
                'exportar' => 'Exportar'
            ]);
        }else{
            $this->setBulkActions([
                'exportar' => 'Exportar'
            ]);
        }

    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id')->sortable()->searchable()->collapseOnTablet(),
            Column::make('Tipo Documento','tipoDocumento.prefijo')->sortable()->searchable()->collapseOnTablet(),
            Column::make('N° Documento','numero_documento')->sortable()->searchable()->collapseOnTablet(),
            Column::make('Nombres','nombres')->sortable()->searchable()->excludeFromColumnSelect()->format(
                fn($value, $row, Column $column) => ucwords($row->nombres)
            ),
            Column::make('Apellidos','apellidos')->sortable()->searchable()->excludeFromColumnSelect()->format(
                fn($value) => ucwords($value)
            ),
            Column::make('Telefono','telefono')->sortable()->searchable()->collapseOnTablet(),
            Column::make('Correo','email')->sortable()->searchable()->collapseOnTablet(),
            Column::make('Curso','curso.nombre')->sortable()->searchable()->collapseOnTablet(),
            Column::make('Estado','estado.nombre')->sortable()->searchable()->collapseOnTablet(),
            Column::make('Fecha Registro', 'created_at')->sortable()->format(fn($value) => $value->format('d/M/Y'))->collapseOnTablet(),
            Column::make('Gestor', 'gestor.nombres')->sortable()->searchable()->format(function($value) {
                if (empty($value)) {
                    return 'No asignado';
                } else {
                    return ucwords($value);
                }
            })
        ];
    }

    public function builder(): Builder
    {
        if(auth()->user()->hasPermissionTo('ver todos estudiantes registrado') || auth()->user()->hasRole('Super Administrador')){
            return RegistrosUsuarios::query();
        }else{
            $consulta = users_categorias::select('categoria_id')->where('user_id', auth()->user()->id)->get();
            $categorias=[];
            foreach($consulta as $categoria){
                array_push($categorias, $categoria->categoria_id);
            }
            return RegistrosUsuarios::query()->wherehas('curso', function($query) use ($categorias){
                $query->whereIn('categoria_id', $categorias);
            })->orWhere('gestor_id', auth()->user()->id);
        }
    }

    public function eliminarMasiva()
    {
        dd('hola');
    }

    public function asiganrGestor()
    {
        $this->dispatchBrowserEvent('abrirModal');
    }

    public function exportar()
    {
        dd('hola');
    }

    public function asignarGestores($gestroId)
    {
        if($this->getSelected()){
            if($gestroId){
                $consulta = RegistrosUsuarios::whereIn('id', $this->getSelected())->update([
                    'gestor_id' => $gestroId
                ]);
                if($consulta){
                    $this->dispatchBrowserEvent('GuardarCambios', ['mensaje'=>'¡Se ha asignado los estudiantes al gestor de manera satisfactoria!', 'id' => 'cerrarGestor' ]);
                    $this->clearSelected();
                }
            }else{
                $this->dispatchBrowserEvent('informacion', ['mensaje'=>'¡Seleccione el gestor!', 'id'=>'cerrarGestor', 'tipoMsj'=>'error']);
            }
        }else{
            $this->dispatchBrowserEvent('informacion', ['mensaje'=>'¡Seleccione los estudiantes a asignar!', 'id'=>'cerrarGestor', 'tipoMsj'=>'error']);
        }
    }
}
