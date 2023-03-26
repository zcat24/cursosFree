<?php

namespace Database\Seeders;

use App\Models\Admin\Cursos as AdminCursos;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Cursos extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AdminCursos::create([
            'categoria_id' => 1,
            'nombre' => 'Curso comida italiana',
            'descripcion' => 'Trucos y secretos para hacer el mejor Ramen. John Husby nos trae 2 recetas para cocinar Ramen como un profesional. Acceso ilimitado. Certificado de Scoolinary. 100% Online. Fórmate a tu ritmo.',
            'activo' => 1
        ]);
    }
}
