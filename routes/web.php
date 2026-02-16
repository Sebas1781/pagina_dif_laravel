<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;

Route::get('/', [PageController::class, 'inicio'])->name('inicio');
Route::get('/nosotros', [PageController::class, 'nosotros'])->name('nosotros');
Route::get('/servicios', [PageController::class, 'servicios'])->name('servicios');
Route::get('/salud', [PageController::class, 'salud'])->name('salud');
Route::get('/educacion', [PageController::class, 'educacion'])->name('educacion');
Route::get('/directorio', [PageController::class, 'directorio'])->name('directorio');
Route::get('/transparencia', [PageController::class, 'transparencia'])->name('transparencia');
Route::get('/remtys', [PageController::class, 'remtys'])->name('remtys');
