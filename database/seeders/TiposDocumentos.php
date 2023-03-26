<?php

namespace Database\Seeders;

use App\Models\Admin\TiposDocumentos as AdminTiposDocumentos;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TiposDocumentos extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AdminTiposDocumentos::create([
            'prefijo' => 'CC',
            'nombre' => 'Cédula ciudadania',
            'activo' => 1
        ]);

        AdminTiposDocumentos::create([
            'prefijo' => 'TI',
            'nombre' => 'Tarjeta identidad',
            'activo' => 1
        ]);

        AdminTiposDocumentos::create([
            'prefijo' => 'CE',
            'nombre' => 'Cédula de Extranjería',
            'activo' => 1
        ]);

        AdminTiposDocumentos::create([
            'prefijo' => 'TE',
            'nombre' => 'Tarjeta de Extranjería',
            'activo' => 1
        ]);
    }
}
