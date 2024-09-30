@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Asignar Roles a Usuarios</h1>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
            <strong class="font-bold">¡Éxito!</strong>
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    @if($users->count() > 0)
        <table class="min-w-full bg-white shadow-lg rounded-lg overflow-hidden">
            <thead>
                <tr class="bg-gray-200 text-gray-700 uppercase text-sm leading-normal">
                    <th class="py-3 px-6 text-left">Usuario</th>
                    <th class="py-3 px-6 text-left">Correo</th>
                    <th class="py-3 px-6 text-left">Rol Actual</th>
                    <th class="py-3 px-6 text-left">Asignar Nuevo Rol</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm font-light">
                @foreach($users as $user)
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="py-3 px-6 text-left">{{ $user->name }}</td>
                        <td class="py-3 px-6 text-left">{{ $user->email }}</td>
                        <td class="py-3 px-6 text-left">
                            @if($user->roles->isNotEmpty())
                                <span class="text-indigo-600 font-bold">{{ $user->roles->first()->name }}</span>
                            @else
                                <span class="text-red-600">Sin Rol</span>
                            @endif
                        </td>
                        <td class="py-3 px-6 text-left">
                            <form action="{{ route('admin.users.assign-role', $user) }}" method="POST">
                                @csrf
                                <select name="role" class="border border-gray-300 rounded-md px-3 py-1 text-gray-600">
                                    <option value="" disabled selected>Rol</option>
                                    @foreach($roles as $role)
                                        <option value="{{ $role->name }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded mt-2">
                                    Asignar
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Paginación -->
        <div class="mt-4">
            {{ $users->links() }}
        </div>
    @else
        <p class="text-gray-600">No hay usuarios disponibles.</p>
    @endif
</div>
@endsection
