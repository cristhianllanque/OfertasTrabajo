@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold">Editar Oferta</h1>

    <form action="{{ route('ofertas.update', $oferta) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="mt-4">
            <label for="title" class="block">Título:</label>
            <input type="text" name="title" value="{{ $oferta->title }}" class="border border-gray-300 rounded-md w-full">
        </div>

        <div class="mt-4">
            <label for="description" class="block">Descripción:</label>
            <textarea name="description" class="border border-gray-300 rounded-md w-full">{{ $oferta->description }}</textarea>
        </div>

        <div class="mt-4">
            <label for="location" class="block">Ubicación:</label>
            <input type="text" name="location" value="{{ $oferta->location }}" class="border border-gray-300 rounded-md w-full">
        </div>

        <div class="mt-4">
            <label for="salary" class="block">Salario:</label>
            <input type="text" name="salary" value="{{ $oferta->salary }}" class="border border-gray-300 rounded-md w-full">
        </div>

        <div class="mt-6">
            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Actualizar Oferta</button>
        </div>
    </form>
</div>
@endsection
