<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class permisos extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //permisos de cursos
        Permission::create([
            'name' => 'gestionar curso',
            'guard_name' => 'web'
        ]);
        Permission::create([
            'name' => 'crear cursos',
            'guard_name' => 'web'
        ]);
        Permission::create([
            'name' => 'modificar cursos',
            'guard_name' => 'web'
        ]);
        Permission::create([
            'name' => 'eliminar cursos',
            'guard_name' => 'web'
        ]);

        //permisos de usuarios
        Permission::create([
            'name' => 'gestionar usuarios',
            'guard_name' => 'web'
        ]);
        Permission::create([
            'name' => 'crear usuario',
            'guard_name' => 'web'
        ]);
        Permission::create([
            'name' => 'desativar usuario',
            'guard_name' => 'web'
        ]);
        Permission::create([
            'name' => 'asignar roles a usuarios',
            'guard_name' => 'web'
        ]);
        Permission::create([
            'name' => 'editar usuarios',
            'guard_name' => 'web'
        ]);

        //categorias
        Permission::create([
            'name' => 'gestionar categorias',
            'guard_name' => 'web'
        ]);
        Permission::create([
            'name' => 'asignar categorias',
            'guard_name' => 'web'
        ]);
        Permission::create([
            'name' => 'crear categorias',
            'guard_name' => 'web'
        ]);
        Permission::create([
            'name' => 'eliminar categorias',
            'guard_name' => 'web'
        ]);
        Permission::create([
            'name' => 'actualizar categorias',
            'guard_name' => 'web'
        ]);

        //permisos modulos
        Permission::create([
            'name' => 'modulo configuraciones',
            'guard_name' => 'web'
        ]);
        Permission::create([
            'name' => 'modulo de consultas',
            'guard_name' => 'web'
        ]);


        //permisos roles
        Permission::create([
            'name' => 'gestionar roles',
            'guard_name' => 'web'
        ]);
        Permission::create([
            'name' => 'crear roles',
            'guard_name' => 'web'
        ]);
        Permission::create([
            'name' => 'actualizar roles',
            'guard_name' => 'web'
        ]);
        Permission::create([
            'name' => 'eliminar roles',
            'guard_name' => 'web'
        ]);

        //permisos permisos
        Permission::create([
            'name' => 'gestionar permisos',
            'guard_name' => 'web'
        ]);
        Permission::create([
            'name' => 'crear permisos',
            'guard_name' => 'web'
        ]);
        Permission::create([
            'name' => 'actulizar permisos',
            'guard_name' => 'web'
        ]);
        Permission::create([
            'name' => 'eliminar permisos',
            'guard_name' => 'web'
        ]);


        //permisos estados
        Permission::create([
            'name' => 'gestionar estados',
            'guard_name' => 'web'
        ]);
        Permission::create([
            'name' => 'actulizar estados',
            'guard_name' => 'web'
        ]);
        Permission::create([
            'name' => 'crear estados',
            'guard_name' => 'web'
        ]);
        Permission::create([
            'name' => 'eliminar estados',
            'guard_name' => 'web'
        ]);

        //administrar cursos y gestores
        Permission::create([
            'name' => 'ver todos estudiantes registrado',
            'guard_name' => 'web'
        ]);

        Permission::create([
            'name' => 'asignar masivamente los cursos a los gestores',
            'guard_name' => 'web'
        ]);

        Permission::create([
            'name' => 'auto-asignar cursos',
            'guard_name' => 'web'
        ]);

    }
}
