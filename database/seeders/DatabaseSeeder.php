<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Llamamos al seeder de roles
        $this->call(RoleSeeder::class);

        // Crear al usuario Administrador
        \App\Models\User::create([
            'name' => 'Jon Admin',
            'email' => 'admin@venue.com',
            'password' => Hash::make('12345678'), // Encriptar la contraseña
            'role_id' => 1, // Asignar el rol de admin
        ]);
    }
}