@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-3xl font-bold text-center text-gray-800">Crear Nueva Oferta Laboral</h1>

    <form action="{{ route('ofertas.store') }}" method="POST" class="mt-6">
        @csrf
        <div class="mb-4">
            <label for="title" class="block text-gray-700">Título de la Oferta</label>
            <input type="text" name="title" id="title" class="w-full p-2 border border-gray-300 rounded" required>
        </div>

        <div class="mb-4">
            <label for="description" class="block text-gray-700">Descripción de la Oferta</label>
            <textarea name="description" id="description" class="w-full p-2 border border-gray-300 rounded" rows="4" required></textarea>
        </div>

        <div class="mb-4">
            <label for="salary" class="block text-gray-700">Salario</label>
            <input type="text" name="salary" id="salary" class="w-full p-2 border border-gray-300 rounded">
        </div>

        <div class="mb-4">
            <label for="location" class="block text-gray-700">Ubicación</label>
            <input type="text" name="location" id="location" class="w-full p-2 border border-gray-300 rounded">
        </div>

        <div class="flex justify-end">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                Publicar Oferta
            </button>
        </div>
    </form>
</div>
@endsection
