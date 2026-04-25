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
use App\Http\Controllers\Admin\SevacController;
use App\Http\Controllers\Admin\ConacController;
use App\Http\Controllers\Admin\PresupuestoController;
use App\Http\Controllers\Admin\CarruselController;
use App\Http\Controllers\Admin\AreaAtencionController;
use App\Http\Controllers\Admin\ServicioSaludController;
use App\Http\Controllers\Admin\ConfiguracionNosotrosController;
use App\Http\Controllers\Admin\SedeDifController;
use App\Http\Controllers\Admin\ServicioSeccionItemController;
use App\Http\Controllers\Admin\ServicioCategoriaController;
use App\Http\Controllers\Admin\SaludServicioController;
use App\Http\Controllers\Admin\UnidadMedicaController;
use App\Http\Controllers\Admin\DirectorioItemController;
use App\Http\Controllers\Admin\RemtysCardController;
use App\Http\Controllers\Admin\RemtysDocumentoController;
use App\Http\Controllers\Admin\DocumentoInicioController;

Route::get('/', [PageController::class, 'inicio'])->name('inicio');
Route::get('/nosotros', [PageController::class, 'nosotros'])->name('nosotros');
Route::get('/servicios', [PageController::class, 'servicios'])->name('servicios');
Route::get('/salud', [PageController::class, 'salud'])->name('salud');
Route::get('/educacion', [PageController::class, 'educacion'])->name('educacion');
Route::get('/directorio', [PageController::class, 'directorio'])->name('directorio');
Route::get('/transparencia', [PageController::class, 'transparencia'])->name('transparencia');
Route::get('/remtys', [PageController::class, 'remtys'])->name('remtys');
Route::get('/boletines', [PageController::class, 'boletines'])->name('boletines');
Route::get('/boletines/{boletin}', [PageController::class, 'boletinDetalle'])->name('boletines.show');

// ── Admin Panel ────────────────────────────────────────────────
Route::prefix('admin')->name('admin.')->group(function () {

    // Login (público)
    Route::get('/login',  [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');

    // Rutas protegidas
    Route::middleware('admin')->group(function () {
        Route::post('/logout',    [AuthController::class, 'logout'])->name('logout');
        Route::get('/dashboard',  [DashboardController::class, 'index'])->name('dashboard');

        // Carrusel de inicio
        Route::resource('carrusel', CarruselController::class)->except(['show']);

        // PDFs de inicio
        Route::resource('documentos_inicio', DocumentoInicioController::class)->except(['show']);

        // Inicio: Areas de atencion y Servicios de salud
        Route::resource('areas_atencion', AreaAtencionController::class)->except(['show']);
        Route::resource('servicios_salud', ServicioSaludController::class)->except(['show']);

        // Nosotros
        Route::get('configuracion_nosotros', [ConfiguracionNosotrosController::class, 'edit'])->name('configuracion_nosotros.edit');
        Route::put('configuracion_nosotros', [ConfiguracionNosotrosController::class, 'update'])->name('configuracion_nosotros.update');
        Route::resource('sedes_dif', SedeDifController::class)->except(['show']);

        // Pagina Servicios
        Route::resource('servicio_items', ServicioSeccionItemController::class)
            ->parameters(['servicio_items' => 'servicioItem'])
            ->except(['show']);
        Route::get('servicio_categorias/create', [ServicioCategoriaController::class, 'create'])->name('servicio_categorias.create');
        Route::post('servicio_categorias', [ServicioCategoriaController::class, 'store'])->name('servicio_categorias.store');

        // Pagina Salud
        Route::resource('salud_servicios', SaludServicioController::class)
            ->parameters(['salud_servicios' => 'saludServicio'])
            ->except(['show']);
        Route::resource('unidades_medicas', UnidadMedicaController::class)
            ->parameters(['unidades_medicas' => 'unidadesMedica'])
            ->except(['show']);

        // Directorio
        Route::resource('directorio_items', DirectorioItemController::class)
            ->parameters(['directorio_items' => 'directorioItem'])
            ->except(['show']);

        // REMTYS
        Route::resource('remtys_cards', RemtysCardController::class)
            ->parameters(['remtys_cards' => 'remtysCard'])
            ->except(['show']);
        Route::get('remtys_documentos', [RemtysDocumentoController::class, 'index'])->name('remtys_documentos.index');
        Route::get('remtys_documentos/create', [RemtysDocumentoController::class, 'create'])->name('remtys_documentos.create');
        Route::post('remtys_documentos', [RemtysDocumentoController::class, 'store'])->name('remtys_documentos.store');
        Route::get('remtys_documentos/{remtysDocumento}/edit', [RemtysDocumentoController::class, 'edit'])->name('remtys_documentos.edit');
        Route::put('remtys_documentos/{remtysDocumento}', [RemtysDocumentoController::class, 'update'])->name('remtys_documentos.update');
        Route::delete('remtys_documentos/{remtysDocumento}', [RemtysDocumentoController::class, 'destroy'])->name('remtys_documentos.destroy');

        // Boletines
        Route::resource('boletines', BoletinController::class)
            ->parameters(['boletines' => 'boletin'])
            ->except(['show']);

        // Educación y Cultura
        Route::resource('casas_cultura',        CasaCulturaController::class)->except(['show']);
        Route::resource('bibliotecas',          BibliotecaController::class)->except(['show']);
        Route::resource('estancias_infantiles', EstanciaInfantilController::class)->except(['show']);
        Route::resource('eventos_culturales',   EventoCulturalController::class)->except(['show']);

        // Documentos SEVAC
        Route::resource('sevac', SevacController::class)->except(['show']);

        // Documentos CONAC
        Route::resource('conac', ConacController::class)->except(['show']);

        // Documentos Presupuesto
        Route::resource('presupuesto', PresupuestoController::class)->except(['show']);
    });
});
