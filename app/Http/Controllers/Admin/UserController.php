<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    // Método para mostrar todos los usuarios
    public function index()
    {
        $users = User::paginate(10); // Obtener los usuarios con paginación
        $roles = Role::all(); // Obtener todos los roles disponibles
        return view('admin.users.index', compact('users', 'roles'));
    }

    // Método para asignar roles a un usuario
    public function assignRole(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|exists:roles,name', // Validar que el rol existe
        ]);

        // Asignar el rol seleccionado al usuario
        $user->syncRoles($request->role);

        // Redirigir con mensaje de éxito dinámico
        return redirect()->back()->with('success', 'Rol "' . $request->role . '" asignado correctamente a ' . $user->name);
    }
}
