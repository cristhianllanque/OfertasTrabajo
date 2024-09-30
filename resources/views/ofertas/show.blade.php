@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="bg-white shadow-lg rounded-lg p-8">
        <h1 class="text-4xl font-bold text-gray-800 mb-4">{{ $oferta->title }}</h1>

        <div class="mt-4 text-gray-600">
            <p><span class="font-semibold">Descripción:</span> {{ $oferta->description }}</p>
        </div>

        <div class="mt-4 flex items-center">
            <span class="font-semibold text-gray-800">Ubicación:</span>
            <span class="ml-2 text-gray-600">{{ $oferta->location }}</span>
        </div>

        <div class="mt-4 flex items-center">
            <span class="font-semibold text-gray-800">Salario:</span>
            <span class="ml-2 text-gray-600">{{ $oferta->salary }}</span>
        </div>

        <div class="mt-6">
            <p class="text-sm text-gray-500">Publicada por: {{ $oferta->user->name }}</p>
            <p class="text-sm text-gray-500">Fecha de Publicación: {{ $oferta->created_at->format('d M Y') }}</p>
        </div>

        <!-- Opciones de Editar y Eliminar -->
        <div class="mt-6 flex justify-end space-x-4">
            @if(auth()->user()->id === $oferta->user_id || auth()->user()->hasRole('admin'))
                <a href="{{ route('ofertas.edit', $oferta) }}" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">
                    Editar Oferta
                </a>
                <form action="{{ route('ofertas.destroy', $oferta) }}" method="POST" class="inline-block">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
                        Eliminar Oferta
                    </button>
                </form>
            @endif
        </div>
    </div>
</div>
@endsection
