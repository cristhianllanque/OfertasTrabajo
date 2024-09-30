<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Spatie\Permission\Middleware\RoleOrPermissionMiddleware;
use Spatie\Permission\Middlewares\RoleMiddleware;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Registrar el middleware de roles de Spatie
        $this->app['router']->aliasMiddleware('role', RoleOrPermissionMiddleware::class);
    }
}
 