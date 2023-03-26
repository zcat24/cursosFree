<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(Categorias::class);
        $this->call(Estados::class);
        $this->call(TiposDocumentos::class);

        $this->call(permisos::class);
        $this->call(roles::class);
        $this->call(usuarios::class);
    }
}
