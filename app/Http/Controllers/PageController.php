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
use App\Models\AreaAtencion;
use App\Models\ServicioSalud;
use App\Models\ConfiguracionNosotros;
use App\Models\SedeDif;
use App\Models\ServicioSeccionItem;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Schema;

class PageController extends Controller
{
    public function inicio()
    {
        $slides    = Carrusel::activos()->get();
        $boletines = Boletin::activos()->take(3)->get();

        $areasAtencion = collect();
        if (Schema::hasTable('areas_atencion')) {
            $areasAtencion = AreaAtencion::activos()->get();
        }
        if ($areasAtencion->isEmpty()) {
            $areasAtencion = $this->areasAtencionPorDefecto();
        }

        $serviciosSalud = collect();
        if (Schema::hasTable('servicios_salud')) {
            $serviciosSalud = ServicioSalud::activos()->get();
        }
        if ($serviciosSalud->isEmpty()) {
            $serviciosSalud = $this->serviciosSaludPorDefecto();
        }

        return view('pages.inicio', compact('slides', 'boletines', 'areasAtencion', 'serviciosSalud'));
    }

    private function areasAtencionPorDefecto(): Collection
    {
        return collect([
            (object) ['nombre' => 'Salud y Bienestar', 'icono' => 'fa-stethoscope', 'color_gradiente' => 'from-dif-pink to-dif-pink-light', 'enlace' => route('salud')],
            (object) ['nombre' => 'Educacion y Cultura', 'icono' => 'fa-book-open', 'color_gradiente' => 'from-teal-500 to-teal-400', 'enlace' => route('educacion')],
            (object) ['nombre' => 'Juridico', 'icono' => 'fa-gavel', 'color_gradiente' => 'from-purple-800 to-purple-600', 'enlace' => route('servicios')],
            (object) ['nombre' => 'Centros de Atencion Integral a la Diversidad Sexual', 'icono' => 'fa-heart', 'color_gradiente' => 'from-rose-400 to-pink-300', 'enlace' => null],
            (object) ['nombre' => 'Centros de Desarrollo Juvenil', 'icono' => 'fa-users', 'color_gradiente' => 'from-amber-500 to-amber-400', 'enlace' => null],
            (object) ['nombre' => 'Puerta Violeta', 'icono' => 'fa-door-open', 'color_gradiente' => 'from-purple-700 to-purple-500', 'enlace' => null],
        ]);
    }

    private function serviciosSaludPorDefecto(): Collection
    {
        return collect([
            (object) ['nombre' => 'Unidad Medica Mandarinas', 'descripcion' => 'Fracc. Ojo de Agua, calle Mandarinas, esq. Naranjos, C.P. 55770', 'horario' => 'Lun a Vie: 9:00 - 18:00 hrs | Sab: 9:00 - 13:00 hrs', 'color_horario' => 'text-dif-pink', 'imagen' => 'page1_img8.png'],
            (object) ['nombre' => 'Centro de Equinoterapia', 'descripcion' => 'Carretera Federal Mexico - Pachuca, Km. 38, Sierra Hermosa, 55740', 'horario' => 'Lunes a Viernes: 9:00 - 15:00 hrs', 'color_horario' => 'text-green-600', 'imagen' => 'page1_img29.png'],
            (object) ['nombre' => 'Clinica Materno Infantil', 'descripcion' => 'Juana Belen Gutierrez de Mendoza', 'horario' => 'Lunes a Viernes: 9:00 - 15:00 hrs', 'color_horario' => 'text-blue-600', 'imagen' => 'page1_img38.png'],
            (object) ['nombre' => 'U.B.R.I.S', 'descripcion' => 'Unidad Basica de Rehabilitacion e Integracion Social', 'horario' => 'Lunes a Viernes: 9:00 - 15:00 hrs', 'color_horario' => 'text-purple-600', 'imagen' => 'page1_img37.png'],
            (object) ['nombre' => 'Unidad Medica Reyes Acozac', 'descripcion' => 'C. Ninos Heroes No. 14, Barrio el Calvario, Reyes Acozac, C.P. 55755', 'horario' => 'Lun a Vie: 9:00 - 18:00 hrs', 'color_horario' => 'text-teal-600', 'imagen' => 'page1_img11.png'],
            (object) ['nombre' => 'Laboratorio de Analisis Clinicos', 'descripcion' => 'Analisis clinicos y pruebas especializadas', 'horario' => 'Lunes a Viernes: 9:00 - 15:00 hrs', 'color_horario' => 'text-amber-600', 'imagen' => 'page1_img21.png'],
        ]);
    }

    public function nosotros()
    {
        $configNosotros = null;
        if (Schema::hasTable('configuracion_nosotros')) {
            $configNosotros = ConfiguracionNosotros::first();
        }

        $mision = $configNosotros?->mision ?: $this->misionPorDefecto();
        $vision = $configNosotros?->vision ?: $this->visionPorDefecto();
        $valores = collect($configNosotros?->valores ?: [])->filter()->values();
        if ($valores->isEmpty()) {
            $valores = $this->valoresPorDefecto();
        }

        $sedes = collect();
        if (Schema::hasTable('sedes_dif')) {
            $sedes = SedeDif::activos()->get();
        }
        if ($sedes->isEmpty()) {
            $sedes = $this->sedesPorDefecto();
        }

        return view('pages.nosotros', compact('mision', 'vision', 'valores', 'sedes'));
    }

    public function servicios()
    {
        $serviciosPorCategoria = collect();
        if (Schema::hasTable('servicio_seccion_items')) {
            $serviciosPorCategoria = ServicioSeccionItem::activos()->get()->groupBy('categoria');
        }

        if ($serviciosPorCategoria->isEmpty()) {
            $serviciosPorCategoria = $this->serviciosPorCategoriaPorDefecto();
        }

        return view('pages.servicios', compact('serviciosPorCategoria'));
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

    private function misionPorDefecto(): string
    {
        return 'Ser una institucion que brinde atencion integral a las familias tecamaquenses, promoviendo el bienestar social, la salud, la educacion y la cultura, con un enfoque de derechos humanos e igualdad de genero, contribuyendo al desarrollo pleno de la comunidad.';
    }

    private function visionPorDefecto(): string
    {
        return 'Consolidarnos como la institucion referente en el municipio de Tecamac en materia de desarrollo integral familiar, reconocida por su calidad en los servicios, innovacion en programas sociales y compromiso genuino con las necesidades de cada habitante.';
    }

    private function valoresPorDefecto(): Collection
    {
        return collect([
            'Honestidad y transparencia',
            'Respeto a la dignidad humana',
            'Compromiso social',
            'Igualdad e inclusion',
            'Servicio con calidad y calidez',
            'Solidaridad comunitaria',
        ]);
    }

    private function sedesPorDefecto(): Collection
    {
        return collect([
            (object) ['nombre' => 'Oficinas Centrales DIF Villas del Real', 'icono' => 'fa-building', 'color' => 'dif-pink', 'enlace' => null],
            (object) ['nombre' => 'Unidad Medica Mandarinas', 'icono' => 'fa-hospital', 'color' => 'dif-pink', 'enlace' => null],
            (object) ['nombre' => 'Unidad Medica Los Reyes Acozac', 'icono' => 'fa-stethoscope', 'color' => 'teal-600', 'enlace' => null],
            (object) ['nombre' => 'Centro de Equinoterapia', 'icono' => 'fa-horse', 'color' => 'green-600', 'enlace' => null],
            (object) ['nombre' => 'Centro de Diversidad Los Heroes Tecamac', 'icono' => 'fa-people-group', 'color' => 'purple-600', 'enlace' => null],
            (object) ['nombre' => 'Centro M.I.E.L Urbi Villas', 'icono' => 'fa-hand-holding-heart', 'color' => 'amber-600', 'enlace' => null],
            (object) ['nombre' => 'Solidarios de Corazon', 'icono' => 'fa-heart', 'color' => 'red-500', 'enlace' => null],
            (object) ['nombre' => 'U.B.R.I.S', 'icono' => 'fa-wheelchair', 'color' => 'blue-600', 'enlace' => null],
            (object) ['nombre' => 'Laboratorio de Analisis Clinicos', 'icono' => 'fa-flask', 'color' => 'indigo-600', 'enlace' => null],
        ]);
    }

    private function serviciosPorCategoriaPorDefecto(): Collection
    {
        return collect([
            'bienestar_social' => collect([
                (object) ['nombre' => 'Apoyos alimentarios'],
                (object) ['nombre' => 'Programas de asistencia social'],
                (object) ['nombre' => 'Atencion a grupos vulnerables'],
                (object) ['nombre' => 'Solidarios de Corazon'],
                (object) ['nombre' => 'Centro M.I.E.L Urbi Villas'],
                (object) ['nombre' => 'Comedores comunitarios'],
            ]),
            'derechos' => collect([
                (object) ['nombre' => 'Atencion a mujeres victimas de violencia'],
                (object) ['nombre' => 'Asesoria psicologica'],
                (object) ['nombre' => 'Programas de equidad de genero'],
                (object) ['nombre' => 'Atencion a la diversidad sexual'],
                (object) ['nombre' => 'Programas para jovenes'],
                (object) ['nombre' => 'Centro de Diversidad Los Heroes'],
            ]),
            'salud' => collect([
                (object) ['nombre' => 'Consulta medica general'],
                (object) ['nombre' => 'Terapia psicologica'],
                (object) ['nombre' => 'Consulta nutricional'],
                (object) ['nombre' => 'Consulta dental'],
                (object) ['nombre' => 'Consulta ginecologia'],
                (object) ['nombre' => 'Consulta pediatra'],
                (object) ['nombre' => 'Terapia fisica'],
                (object) ['nombre' => 'Equinoterapia'],
                (object) ['nombre' => 'Laboratorio de analisis clinicos'],
            ]),
            'educacion_cultura' => collect([
                (object) ['nombre' => 'Casas de Cultura (6 sedes)'],
                (object) ['nombre' => 'Bibliotecas municipales (15+)'],
                (object) ['nombre' => 'Estancias infantiles (7 sedes)'],
                (object) ['nombre' => 'Eventos culturales'],
                (object) ['nombre' => 'Orquesta Filarmonica Municipal'],
                (object) ['nombre' => 'Servicio social y colaboraciones'],
            ]),
            'juridico' => collect([
                (object) ['nombre' => 'Asesoria juridica familiar'],
                (object) ['nombre' => 'Mediacion y conciliacion'],
                (object) ['nombre' => 'Proteccion a la infancia'],
                (object) ['nombre' => 'Tramites de custodia y pension'],
                (object) ['nombre' => 'Atencion a adultos mayores'],
                (object) ['nombre' => 'Defensa de derechos'],
            ]),
        ]);
    }
}
