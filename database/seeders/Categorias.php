<?php

namespace Database\Seeders;

use App\Models\Admin\Categorias as AdminCategorias;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Categorias extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AdminCategorias::create([
            'prefijo' => 'GTM',
            'nombre' => 'Gastronomia',
            'activo' => 1
        ]);

        AdminCategorias::create([
            'prefijo' => 'DVP',
            'nombre' => 'Desarrollo software',
            'activo' => 1
        ]);
        
        $this->call(Cursos::class);
    }
}
