<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\BoletinController;
use App\Http\Controllers\Admin\CasaCulturaController;
use App\Http\Controllers\Admin\BibliotecaController;
use App\Http\Controllers\Admin\EstanciaInfantilController;
use App\Http\Controllers\Admin\EventoCulturalController;

Route::get('/', [PageController::class, 'inicio'])->name('inicio');
Route::get('/nosotros', [PageController::class, 'nosotros'])->name('nosotros');
Route::get('/servicios', [PageController::class, 'servicios'])->name('servicios');
Route::get('/salud', [PageController::class, 'salud'])->name('salud');
Route::get('/educacion', [PageController::class, 'educacion'])->name('educacion');
Route::get('/directorio', [PageController::class, 'directorio'])->name('directorio');
Route::get('/transparencia', [PageController::class, 'transparencia'])->name('transparencia');
Route::get('/remtys', [PageController::class, 'remtys'])->name('remtys');
Route::get('/boletines', [PageController::class, 'boletines'])->name('boletines');

// ── Admin Panel ────────────────────────────────────────────────
Route::prefix('admin')->name('admin.')->group(function () {

    // Login (público)
    Route::get('/login',  [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');

    // Rutas protegidas
    Route::middleware('admin')->group(function () {
        Route::post('/logout',    [AuthController::class, 'logout'])->name('logout');
        Route::get('/dashboard',  [DashboardController::class, 'index'])->name('dashboard');

        // Boletines
        Route::resource('boletines', BoletinController::class)->except(['show']);

        // Educación y Cultura
        Route::resource('casas_cultura',        CasaCulturaController::class)->except(['show']);
        Route::resource('bibliotecas',          BibliotecaController::class)->except(['show']);
        Route::resource('estancias_infantiles', EstanciaInfantilController::class)->except(['show']);
        Route::resource('eventos_culturales',   EventoCulturalController::class)->except(['show']);
    });
});
