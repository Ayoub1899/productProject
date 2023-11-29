<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Créer l'utilisateur admin
        User::create([
            'name' => 'Admin',
            'email' => 'admin@mail.com',
            'password' => Hash::make('password'),
            'role' => 'admin'
        ]);

        // Création d'un utilisateur manager
        User::create([
            'name' => 'Manager',
            'email' => 'manager@mail.com',
            'password' => Hash::make('password'),
            'role' => 'manager'
        ]);
    }
}
