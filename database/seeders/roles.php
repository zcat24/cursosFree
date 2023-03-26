<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class roles extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = Role::create([
            'name' => 'Super Administrador',
            'guard_name' => 'web'
        ]);

        $permissions = Permission::all();

        $role->syncPermissions($permissions);

        Role::create([
            'name' => 'Gestor de cursos',
            'guard_name' => 'web'
        ]);
        
        Role::create([
            'name' => 'creador de cursos',
            'guard_name' => 'web'
        ]);  

    }
}
