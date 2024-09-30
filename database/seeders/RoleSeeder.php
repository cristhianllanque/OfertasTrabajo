<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Verificar si los roles ya existen antes de crearlos
        if (!Role::where('name', 'admin')->exists()) {
            Role::create(['name' => 'admin']);
        }

        if (!Role::where('name', 'empresa')->exists()) {
            Role::create(['name' => 'empresa']);
        }

        if (!Role::where('name', 'postulante')->exists()) {
            Role::create(['name' => 'postulante']);
        }

        if (!Role::where('name', 'supervisor')->exists()) {
            Role::create(['name' => 'supervisor']);
        }
    }
}
