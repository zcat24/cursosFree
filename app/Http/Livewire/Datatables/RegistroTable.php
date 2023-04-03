<?php

namespace App\Http\Livewire\Datatables;

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
        $this->setBulkActions([
            'eliminarMasiva' => 'Eliminar',
            'asiganrGestor' => 'Asignar Gestor',
            'exportar' => 'Exportar'
        ]);

    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id')->sortable()->searchable()->collapseOnTablet(),
            Column::make('Tipo Documento','tipoDocumento.prefijo')->sortable()->searchable()->collapseOnTablet(),
            Column::make('N° Documento','numero_documento')->sortable()->searchable()->collapseOnTablet(),
            Column::make('Nombres','nombres')->sortable()->searchable(),
            Column::make('Apellidos','apellidos')->sortable()->searchable(),
            Column::make('Telefono','telefono')->sortable()->searchable()->collapseOnTablet(),
            Column::make('Correo','email')->sortable()->searchable()->collapseOnTablet(),
            Column::make('Curso','curso.nombre')->sortable()->searchable()->collapseOnTablet(),
            Column::make('Estado','estado.nombre')->sortable()->searchable()->collapseOnTablet(),
            Column::make('Fecha Registro', 'created_at')->sortable()->format(fn($value) => $value->format('d/M/Y'))->collapseOnTablet(),
            Column::make('Gestor', 'gestor_id')->sortable()->searchable()
        ];
    }

    public function builder(): Builder
    {
        return RegistrosUsuarios::query();
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
                }
            }else{
                $this->dispatchBrowserEvent('informacion', ['mensaje'=>'¡Seleccione el gestor!', 'id'=>'cerrarGestor', 'tipoMsj'=>'error']);
            }
        }else{
            $this->dispatchBrowserEvent('informacion', ['mensaje'=>'¡Seleccione los estudiantes a asignar!', 'id'=>'cerrarGestor', 'tipoMsj'=>'error']);
        }
    }

}
