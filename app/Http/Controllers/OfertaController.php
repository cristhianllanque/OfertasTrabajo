<?php

namespace App\Http\Controllers;

use App\Models\Oferta;
use Illuminate\Http\Request;

class OfertaController extends Controller
{
    // Mostrar todas las ofertas (postulantes pueden ver todas, empresas ven las suyas)
    public function index()
    {
        // Si el usuario es una empresa, solo ve sus propias ofertas
        if (auth()->user()->hasRole('empresa')) {
            $ofertas = Oferta::where('user_id', auth()->user()->id)->get();
        } else {
            // Si es administrador o postulante, ver todas las ofertas
            $ofertas = Oferta::all();
        }

        return view('ofertas.index', compact('ofertas')); // Pasa las ofertas a la vista
    }

    // Mostrar formulario para crear una nueva oferta (solo empresas)
    public function create()
    {
        // Verifica que solo los usuarios con el rol 'empresa' puedan acceder a esta vista
        if (auth()->user()->hasRole('empresa')) {
            return view('ofertas.create'); // Vista en 'resources/views/ofertas/create.blade.php'
        }

        // Si no es una empresa, devuelve un error 403 (prohibido)
        abort(403, 'No tienes permiso para crear ofertas laborales.');
    }

    // Almacenar una nueva oferta laboral
    public function store(Request $request)
    {
        // Validación de los datos de la oferta
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'salary' => 'nullable|string',
            'location' => 'nullable|string',
        ]);

        // Crear la oferta y asignar el ID del usuario (empresa)
        Oferta::create([
            'title' => $request->title,
            'description' => $request->description,
            'salary' => $request->salary,
            'location' => $request->location,
            'user_id' => auth()->user()->id,  // Asigna el ID del usuario (empresa)
        ]);

        // Redirigir a la vista de todas las ofertas con un mensaje de éxito
        return redirect()->route('ofertas.index')->with('success', 'Oferta laboral publicada correctamente.');
    }

    // Mostrar los detalles de una oferta
    public function show(Oferta $oferta)
    {
        return view('ofertas.show', compact('oferta')); // Vista en 'resources/views/ofertas/show.blade.php'
    }

    // Mostrar formulario para editar una oferta (solo empresas o admin)
    public function edit(Oferta $oferta)
    {
        // Verifica que el usuario sea el propietario de la oferta o admin
        if (auth()->user()->id !== $oferta->user_id && !auth()->user()->hasRole('admin')) {
            abort(403, 'No tienes permiso para editar esta oferta.');
        }
        return view('ofertas.edit', compact('oferta')); // Vista en 'resources/views/ofertas/edit.blade.php'
    }

    // Actualizar una oferta
    public function update(Request $request, Oferta $oferta)
    {
        // Verifica que el usuario sea el propietario de la oferta o admin
        if (auth()->user()->id !== $oferta->user_id && !auth()->user()->hasRole('admin')) {
            abort(403, 'No tienes permiso para editar esta oferta.');
        }

        // Validación de los datos actualizados
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'salary' => 'nullable|string',
            'location' => 'nullable|string',
        ]);

        // Actualizar los datos de la oferta
        $oferta->update($request->all());

        // Redirigir a la vista de todas las ofertas con un mensaje de éxito
        return redirect()->route('ofertas.index')->with('success', 'Oferta actualizada correctamente.');
    }

    // Eliminar una oferta
    public function destroy(Oferta $oferta)
    {
        // Verifica que el usuario sea el propietario de la oferta o admin
        if (auth()->user()->id !== $oferta->user_id && !auth()->user()->hasRole('admin')) {
            abort(403, 'No tienes permiso para eliminar esta oferta.');
        }

        // Eliminar la oferta
        $oferta->delete();

        // Redirigir a la vista de todas las ofertas con un mensaje de éxito
        return redirect()->route('ofertas.index')->with('success', 'Oferta eliminada correctamente.');
    }
}
