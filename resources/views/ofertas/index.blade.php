@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-3xl font-bold text-center text-gray-800">Ofertas Laborales</h1>

    <!-- Verificar si el usuario es admin o empresa para mostrar el botón de creación -->
    @if(auth()->user()->hasRole('empresa') || auth()->user()->hasRole('admin'))
        <div class="mt-4 flex justify-end">
            <a href="{{ route('ofertas.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                Crear Nueva Oferta
            </a>
        </div>
    @endif

    <div class="mt-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        <!-- Iterar sobre las ofertas -->
        @forelse($ofertas as $oferta)
            <div class="bg-white shadow rounded-lg p-6">
                <h2 class="text-xl font-semibold text-gray-700">{{ $oferta->title }}</h2>
                <p class="mt-2 text-gray-500">{{ $oferta->description }}</p>
                <p class="mt-2 text-gray-500">Ubicación: {{ $oferta->location }}</p>
                <p class="mt-2 text-gray-500">Salario: {{ $oferta->salary }}</p>
                
                <!-- Botón Ver Detalles -->
                <a href="{{ route('ofertas.show', $oferta) }}" class="mt-4 inline-block bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                    Ver Detalles
                </a>

                <!-- Solo mostrar botones de Editar y Eliminar si el usuario es dueño de la oferta o admin -->
                @if(auth()->user()->id === $oferta->user_id || auth()->user()->hasRole('admin'))
                    <a href="{{ route('ofertas.edit', $oferta) }}" class="mt-2 inline-block bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">
                        Editar
                    </a>

                    <!-- Botón Eliminar con SweetAlert -->
                    <button type="button" class="mt-2 bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600" onclick="confirmDelete({{ $oferta->id }})">
                        Eliminar
                    </button>

                    <form id="delete-form-{{ $oferta->id }}" action="{{ route('ofertas.destroy', $oferta) }}" method="POST" style="display: none;">
                        @csrf
                        @method('DELETE')
                    </form>
                @endif
            </div>
        @empty
            <p class="text-center text-gray-500">No hay ofertas disponibles en este momento.</p>
        @endforelse
    </div>
</div>

<!-- SweetAlert script -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    function confirmDelete(ofertaId) {
        Swal.fire({
            title: '¿Estás seguro?',
            text: "¡No podrás revertir esto!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'No, cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + ofertaId).submit();
            }
        })
    }
</script>
@endsection
