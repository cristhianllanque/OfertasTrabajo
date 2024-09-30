<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear usuario admin
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin'), // Cambia la contraseña si lo deseas
        ]);

        // Asegúrate de que el rol 'admin' existe
        if (Role::where('name', 'admin')->doesntExist()) {
            Role::create(['name' => 'admin']);
        }

        // Asignar el rol de admin al usuario
        $admin->assignRole('admin');
    }
}
