@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-3xl font-bold text-center text-gray-800">Panel de Administración</h1>

    <div class="mt-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        <div class="bg-white shadow rounded-lg p-6">
            <h2 class="text-xl font-semibold text-gray-700">Gestión de Usuarios</h2>
            <p class="mt-2 text-gray-500">Administra los usuarios y sus roles desde esta sección.</p>
            <a href="{{ route('admin.users.index') }}" class="mt-4 inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                Ver Usuarios
            </a>
        </div>

        <!-- Puedes añadir más tarjetas para gestionar otras funcionalidades -->
    </div>
</div>
@endsection
