<?php

namespace App\Http\Controllers;

use App\Models\Boletin;
use App\Models\Carrusel;
use App\Models\CasaCultura;
use App\Models\Biblioteca;
use App\Models\EstanciaInfantil;
use App\Models\EventoCultural;
use App\Models\DocumentoSevac;
use App\Models\DocumentoConac;
use App\Models\DocumentoPresupuesto;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function inicio()
    {
        $slides    = Carrusel::activos()->get();
        $boletines = Boletin::activos()->take(3)->get();
        return view('pages.inicio', compact('slides', 'boletines'));
    }

    public function nosotros()
    {
        return view('pages.nosotros');
    }

    public function servicios()
    {
        return view('pages.servicios');
    }

    public function salud()
    {
        return view('pages.salud');
    }

    public function educacion()
    {
        return view('pages.educacion', [
            'casas'     => CasaCultura::activos()->get(),
            'bibliotecas' => Biblioteca::activos()->get(),
            'estancias' => EstanciaInfantil::activos()->get(),
            'eventos'   => EventoCultural::activos()->get(),
        ]);
    }

    public function directorio()
    {
        return view('pages.directorio');
    }

    public function transparencia()
    {
        $sevacData        = DocumentoSevac::agrupadosPorAnio();
        $sevacAnios       = DocumentoSevac::aniosDisponibles();
        $conacData        = DocumentoConac::agrupadosPorAnio();
        $conacAnios       = DocumentoConac::aniosDisponibles();
        $presupuestoData  = DocumentoPresupuesto::agrupadosPorAnio();
        $presupuestoAnios = DocumentoPresupuesto::aniosDisponibles();

        return view('pages.transparencia', compact('sevacData', 'sevacAnios', 'conacData', 'conacAnios', 'presupuestoData', 'presupuestoAnios'));
    }

    public function remtys()
    {
        return view('pages.remtys');
    }

    public function boletines()
    {
        $boletines = Boletin::activos()->get();
        return view('pages.boletines', compact('boletines'));
    }

    public function boletinDetalle(Boletin $boletin)
    {
        abort_unless($boletin->activo, 404);
        $recientes = Boletin::activos()->where('id', '!=', $boletin->id)->take(3)->get();
        return view('pages.boletin-detalle', compact('boletin', 'recientes'));
    }
}
