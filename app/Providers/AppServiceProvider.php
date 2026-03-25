<?php

namespace App\Providers;

use App\Models\DocumentoConac;
use App\Models\DocumentoSevac;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
        // Compartir los años SEVAC disponibles con el layout público
        View::composer('layouts.app', function ($view) {
            $view->with('sevacAniosNav', DocumentoSevac::aniosDisponibles());
            $view->with('conacAniosNav', DocumentoConac::aniosDisponibles());
        });
    }
}
