<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Llamar al seeder de roles
        $this->call(RoleSeeder::class);

        // Crear usuario admin si no existe
        $adminUser = User::where('email', 'admin@gmail.com')->first();
        if (!$adminUser) {
            $adminUser = User::create([
                'name' => 'Admin User',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('admin'), // La contraseña es 'admin'
            ]);
        }

        // Asignar rol de admin al usuario
        $adminUser->assignRole('admin');
    }
}
