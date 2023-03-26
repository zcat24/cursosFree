<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class usuarios extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'username' => 'wsanabria',
            'nombres' => 'Wilson Alejandro Sanabria',
            'cedula' => '1023943390',
            'fecha_nacimiento' => '1996-07-03',
            'email' => 'Wasanabriag37@gmail.com',
            'password' => Hash::make('123456789'),
            'activo' => true
        ]);

        $user->assignRole(1);

    }
}
