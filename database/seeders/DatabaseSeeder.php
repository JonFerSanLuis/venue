<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // 1. Primero llamamos al seeder de roles (que creamos antes)
        $this->call(RoleSeeder::class);

        // 2. Creamos al usuario Administrador por defecto
        \App\Models\User::create([
            'name' => 'Jon Admin',
            'email' => 'admin@venue.com',
            'password' => Hash::make('12345678'), // Encriptamos la contraseña
            'role_id' => 1, // Le asignamos el rol de admin directamente
        ]);
    }
}