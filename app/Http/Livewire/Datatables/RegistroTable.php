<?php

namespace App\Http\Livewire\Datatables;

use App\Models\Gestion\RegistrosUsuarios;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Illuminate\Database\Eloquent\Builder;

class RegistroTable extends DataTableComponent
{
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
            Column::make('Tipo Docto','tipoDocumento.prefijo')->sortable()->searchable()->collapseOnTablet(),
            Column::make('N° Docto','numero_documento')->sortable()->searchable()->collapseOnTablet(),
            Column::make('Nombres','nombres')->sortable()->searchable(),
            Column::make('Apellidos','apellidos')->sortable()->searchable(),
            Column::make('Telefono','telefono')->sortable()->searchable()->collapseOnTablet(),
            Column::make('Correo','email')->sortable()->searchable()->collapseOnTablet(),
            Column::make('Curso','curso.nombre')->sortable()->searchable()->collapseOnTablet(),
            Column::make('Estado','estado.nombre')->sortable()->searchable()->collapseOnTablet(),
            Column::make('Fecha Registro', 'created_at')->sortable()->format(fn($value) => $value->format('d/M/Y'))->collapseOnTablet()
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
        dd('hola');
    }

    public function exportar()
    {
        dd('hola');
    }

}
