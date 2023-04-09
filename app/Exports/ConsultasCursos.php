<?php

namespace App\Exports;

use App\Models\Admin\Categorias;
use App\Models\Admin\Cursos;
use App\Models\Admin\users_categorias;
use App\Models\Gestion\RegistrosUsuarios;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Excel;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Illuminate\Contracts\Support\Responsable;

class ConsultasCursos implements FromCollection, WithCustomStartCell, WithHeadings, Responsable, WithDrawings, WithMapping, ShouldAutoSize, WithStyles 
{
    use Exportable;
    
    private $fileName = 'Cursos.xlsx';

    private $writerType = Excel::XLSX;

    public $tipoconsulta, $fechaDesde, $fechaHasta;

    public function __construct($tipoconsulta,  $fechaDesde, $fechaHasta)
    {
        $this->tipoconsulta = $tipoconsulta;
        $this->fechaDesde = $fechaDesde;
        $this->fechaHasta = $fechaHasta;

    }


    public function collection()
    {
        switch ($this->tipoconsulta) {
            case 1:
                $consulta = Categorias::whereBetween('created_at', [$this->fechaDesde, $this->fechaHasta])
                                        ->get();
                return $consulta;
            break;

            case 2:
                $consulta = Cursos::whereBetween('created_at', [$this->fechaDesde, $this->fechaHasta])
                                    ->get();
                return $consulta;
            break;

            case 3:
                $consulta = RegistrosUsuarios::whereBetween('created_at', [$this->fechaDesde, $this->fechaHasta])
                                                ->get();
                return $consulta;
            break;

            case 4:
               $consulta = users_categorias::whereBetween('updated_at', [$this->fechaDesde, $this->fechaHasta])
                                ->get(); 

                return $consulta;                  
            break;
        }
    }

    public function StartCell(): string
    {
        return 'A6';
    }

    public function drawings()
    {
        $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
        $drawing->setName('cursosfree');
        $drawing->setDescription('cursosfree');
        $drawing->setPath(public_path('img/curso.png'));
        $drawing->setHeight(90);
        $drawing->setCoordinates('B1');

        return $drawing;
    }

    public function map($consulta): array
    {
        switch($this->tipoconsulta){
            case 1:
                return[
                    strtoupper($consulta->prefijo),
                    ucfirst($consulta->nombre),
                    $consulta->created_at,
                    $consulta->updated_at
                ];
            break;

            case 2:
                if($consulta->creador_id){
                    $creador = ucfirst($consulta->creador->nombres);
                }else{
                    $creador = 'Administrativo';
                }
                if($consulta->activo == 1){
                    $activo = 'Activo';
                }else{
                    $activo = 'No activo';
                }
                return [
                    ucfirst($consulta->categoria->nombre),
                    ucfirst($consulta->nombre),
                    ucfirst($consulta->descripcion),
                    $creador,
                    $activo,
                    $consulta->created_at,
                    $consulta->updated_at
                ];
            break;
            
            case 3:
                if($consulta->gestor_id){
                    $gestor = ucfirst($consulta->gestor->nombres);
                }else{
                    $gestor = 'No asignado';
                }
                return [
                    strtoupper($consulta->tipoDocumento->prefijo).'-'.$consulta->numero_documento,
                    ucwords($consulta->nombres).' '.ucwords($consulta->apellidos),
                    number_format($consulta->telefono, 0),
                    ucfirst($consulta->email),
                    ucfirst($consulta->curso->nombre),
                    $gestor,
                    ucfirst($consulta->estado->nombre),
                    $consulta->created_at,
                    $consulta->updated_at
                ];
            break;
            
            case 4:
                return [
                    ucwords($consulta->gestores->nombres),
                    number_format($consulta->gestores->cedula, 0),
                    ucfirst($consulta->gestores->email),
                    ucfirst($consulta->categoriaAsignada->nombre),
                    $consulta->created_at,
                    $consulta->updated_at
                ];
            break;    
        }
    }

    public function styles(Worksheet $hoja)
    {
        switch ($this->tipoconsulta)
        {
            case '1':
                $hoja->setTitle('Categorias');
                $hoja->mergeCells('A1:B5');
                $hoja->mergeCells('C1:D5');
                $hoja->getStyle('A6:D6')->applyFromArray([
                    'font' => [
                        'bold' => true
                    ],
                    'alignment' => [
                        'horizontal' => 'center'
                    ],
                    'fill' => [
                        'fillType' => 'solid',
                        'startColor' => [
                            'rgb' => '66CCFF'
                        ]
                    ]
                ]);
                $hoja->setCellValue('C1', 'Categorias');
                $hoja->getStyle('A1:D'.$hoja->getHighestRow())->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => 'thin'
                        ]
                    ],
                ]);
                $hoja->getStyle('A1:D'.$hoja->getHighestRow())->applyFromArray([
                    'alignment' => [
                        'horizontal' => 'center'
                    ],
                ]);
                $hoja->getStyle('C1:D5')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'name' => 'Arial',
                        'size' => 30
                    ],
                    'alignment' => [
                        'horizontal' => 'left',
                        'vertical' => 'center'
                    ],
        
                ]);     
                // $hoja->getStyle('E')->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_CURRENCY_USD_INTEGER);
                // $hoja->getStyle('D')->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_CURRENCY_USD_INTEGER);
                // $hoja->getStyle('F')->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_CURRENCY_USD_INTEGER);
                // $hoja->getStyle('G')->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_CURRENCY_USD_INTEGER);
            break;
                
            case '2':
                $hoja->setTitle('Cursos');
                $hoja->mergeCells('A1:B5');
                $hoja->mergeCells('C1:G5');
                $hoja->getStyle('A6:G6')->applyFromArray([
                    'font' => [
                        'bold' => true
                    ],
                    'alignment' => [
                        'horizontal' => 'center'
                    ],
                    'fill' => [
                        'fillType' => 'solid',
                        'startColor' => [
                            'rgb' => '66CCFF'
                        ]
                    ]
                ]);
                $hoja->setCellValue('C1', 'Cursos');
                $hoja->getStyle('A1:G'.$hoja->getHighestRow())->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => 'thin'
                        ]
                    ],
                ]);
                $hoja->getStyle('A1:G'.$hoja->getHighestRow())->applyFromArray([
                    'alignment' => [
                        'horizontal' => 'center'
                    ],
                ]);
                $hoja->getStyle('C1:G5')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'name' => 'Arial',
                        'size' => 40
                    ],
                    'alignment' => [
                        'horizontal' => 'left',
                        'vertical' => 'center'
                    ],
        
                ]);
                // $hoja->getStyle('E')->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_CURRENCY_USD_INTEGER);
                // $hoja->getStyle('G')->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_CURRENCY_USD_INTEGER);
                // $hoja->getStyle('H')->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_CURRENCY_USD_INTEGER);
            break;
            
            case '3':
                $hoja->setTitle('Registros de estudiantes');
                $hoja->mergeCells('A1:C5');
                $hoja->mergeCells('D1:I5');
                $hoja->getStyle('A6:I6')->applyFromArray([
                    'font' => [
                        'bold' => true
                    ],
                    'alignment' => [
                        'horizontal' => 'center'
                    ],
                    'fill' => [
                        'fillType' => 'solid',
                        'startColor' => [
                            'rgb' => '66CCFF'
                        ]
                    ]
                ]);
                $hoja->setCellValue('D1', 'Registros de Usuarios');
                $hoja->getStyle('A1:I'.$hoja->getHighestRow())->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => 'thin'
                        ]
                    ],
                ]);
                $hoja->getStyle('A1:I'.$hoja->getHighestRow())->applyFromArray([
                    'alignment' => [
                        'horizontal' => 'center'
                    ],
                ]);
                $hoja->getStyle('D1:I5')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'name' => 'Arial',
                        'size' => 38
                    ],
                    'alignment' => [
                        'horizontal' => 'left',
                        'vertical' => 'center'
                    ],
        
                ]);
                // $hoja->getStyle('C')->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_CURRENCY_USD_INTEGER);
                // $hoja->getStyle('D')->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_CURRENCY_USD_INTEGER);
                // $hoja->getStyle('E')->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_CURRENCY_USD_INTEGER);
                // $hoja->getStyle('F')->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_CURRENCY_USD_INTEGER);

            break;
            
            case '4':
                $hoja->setTitle('Gestores de cursos');
                $hoja->mergeCells('A1:B5');
                $hoja->mergeCells('C1:F5');
                $hoja->getStyle('A6:F6')->applyFromArray([
                    'font' => [
                        'bold' => true
                    ],
                    'alignment' => [
                        'horizontal' => 'center'
                    ],
                    'fill' => [
                        'fillType' => 'solid',
                        'startColor' => [
                            'rgb' => '66CCFF'
                        ]
                    ]
                ]);
                // $nombre = Sedes::find($this->sedeId);
                // $nombre = ucfirst($nombre->nombre);
                $hoja->setCellValue('C1', 'Gestores de Cursos ');
                $hoja->getStyle('A1:F'.$hoja->getHighestRow())->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => 'thin'
                        ]
                    ],
                ]);
                $hoja->getStyle('A1:F'.$hoja->getHighestRow())->applyFromArray([
                    'alignment' => [
                        'horizontal' => 'center'
                    ],
                ]);
                $hoja->getStyle('C1:F5')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'name' => 'Arial',
                        'size' => 38
                    ],
                    'alignment' => [
                        'horizontal' => 'left',
                        'vertical' => 'center'
                    ],
        
                ]);
                // $hoja->getStyle('E')->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_CURRENCY_USD_INTEGER);
                // $hoja->getStyle('F')->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_CURRENCY_USD_INTEGER);
                // $hoja->getStyle('H')->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_CURRENCY_USD_INTEGER);
                // $hoja->getStyle('I')->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_CURRENCY_USD_INTEGER);
            break;  
        }
        
    }

    public function headings(): array
    {
        switch ($this->tipoconsulta)
        {
            case '1':
                return [
                    'PREFIJO',
                    'NOMBRE',
                    'FECHA CREACION',
                    'FECHA ACTUALIZACION',
                ];
            break;
            
            case '2':
                return [
                    'CATEGORIA',
                    'NOMBRE DEL CURSO',
                    'DESCRIPCION DEL CURSO',
                    'CREADOR',
                    'ESTADO',
                    'FECHA CREACION',
                    'FECHA ACTUALIZACION'
                ];
            break; 
            
            case '3':
                return [
                    'TIPO - N° DOCUMENTO',
                    'NOMBRES COMPLETOS',
                    'TELEFONO',
                    'CORREO',
                    'CURSO',
                    'GESTOR',
                    'ESTADO',
                    'FECHA CREACION',
                    'FECHA ACTUALIZACION'
                ];
            break;
            
            case '4':
                return[
                    'NOMBRES',
                    'CEDULA',
                    'CORREO',
                    'CATEGORIA ASIGNADA',
                    'FECHA CREACION',
                    'FECHA ACTUALIZACION'
                ];
            break;    
        }
        
    }
}
