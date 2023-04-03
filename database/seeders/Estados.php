<?php

namespace Database\Seeders;

use App\Models\Admin\Estados as AdminEstados;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Estados extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AdminEstados::create([
            'nombre' => 'Solicitado',
            'activo' => true
        ]);

        AdminEstados::create([
            'nombre' => 'Comprado',
            'activo' => true
        ]);

        AdminEstados::create([
            'nombre' => 'Matriculado',
            'activo' => true
        ]);

        AdminEstados::create([
            'nombre' => 'Cancelado',
            'activo' => true
        ]);

    }
}
