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

        AdminCursos::create([
            'categoria_id' => 1,
            'nombre' => 'Panaderia, Pasteleria y Chocolateria',
            'descripcion' => 'Torta especiada con frambuesas, almendras garrapiñadas y chocolate blanco, Merengues de árbol de navidad y coronas navideñas y Galletas de red velvet y chocolate blanco.',
            'activo' => 1
        ]);

        AdminCursos::create([
            'categoria_id' => 1,
            'nombre' => 'Maestría en Gestión e Innovación en Eventos y Gastronomía',
            'descripcion' => '¿Te gustaría profundizar o actualizar tus conocimientos en la implementación de eventos, así como también en el área de la gastronomía? Pues esta información es para ti. Emagister te presenta la Maestría en Gestión e Innovación en Eventos y Gastronomía que la desarrolla e imparte Universidad... Aprende sobre: Objetivos organizacionales, Pensamiento divergente, Informe de desarrollo sostenible...',
            'activo' => 1
        ]);

        AdminCursos::create([
            'categoria_id' => 1,
            'nombre' => 'Tecnología en gestión gastronómica y sommelier',
            'descripcion' => '..un experto sommelier aprendiendo principios en enología, a catar vinos, bebidas espirituosas, licores digestivos y aperitivos; aprendiendo a seleccionar... Aprende sobre: Geografía Vitivinícola, Costos de alimentos y bebidas, Cocina internacional...',
            'activo' => 1
        ]);

        AdminCursos::create([
            'categoria_id' => 1,
            'nombre' => 'Programa de Servicios de Alimentos (Administración Gastronómica)',
            'descripcion' => '..La gastronomía más allá de la experiencia de los sentidos, es un negocio y debe ser gerenciado para que genere la rentabilidad esperada. Nuestro programa de gestión está enfocado en el mercadeo, el servicio y la administración que son tres pilares claves sobre los cuales se construye valor... Aprende sobre: Historia de la Gastronomía, Bebidas y Coctelería, Administración de RRHH...',
            'activo' => 1
        ]);
    }
}
