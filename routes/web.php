<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\OfertaController;
use App\Http\Controllers\AdminController;
use Spatie\Permission\Middlewares\RoleMiddleware;

// Ruta principal
Route::get('/', function () {
    return view('welcome');
});

// Rutas protegidas para administradores y empresas
Route::group(['middleware' => ['auth']], function () {

    // Rutas para el administrador
    Route::middleware('role:admin')->group(function () {

        // Dashboard del administrador
        Route::get('/admin-dashboard', function () {
            return view('admin.dashboard');
        })->name('admin.dashboard');

        // Administración de usuarios
        Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users.index');
        Route::post('/admin/users/{user}/assign-role', [UserController::class, 'assignRole'])->name('admin.users.assign-role');
    });

    // Rutas para la creación y gestión de ofertas, accesible para empresas y admin
    Route::middleware(['role:empresa|admin'])->group(function () {
        Route::get('/ofertas/create', [OfertaController::class, 'create'])->name('ofertas.create'); // Formulario para crear nueva oferta
        Route::post('/ofertas', [OfertaController::class, 'store'])->name('ofertas.store');         // Guardar la oferta en la base de datos
        Route::get('/ofertas/{oferta}/edit', [OfertaController::class, 'edit'])->name('ofertas.edit'); // Editar ofertas
        Route::put('/ofertas/{oferta}', [OfertaController::class, 'update'])->name('ofertas.update'); // Actualizar ofertas
        Route::delete('/ofertas/{oferta}', [OfertaController::class, 'destroy'])->name('ofertas.destroy'); // Eliminar ofertas
    });

    // Rutas para ver ofertas (disponible para todos los usuarios autenticados)
    Route::get('/ofertas', [OfertaController::class, 'index'])->name('ofertas.index');
    Route::get('/ofertas/{oferta}', [OfertaController::class, 'show'])->name('ofertas.show'); // Ver detalles de una oferta
});

// Rutas protegidas con autenticación para cualquier usuario autenticado (para el dashboard general)
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
