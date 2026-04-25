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
use App\Models\ServicioCategoria;
use App\Models\SaludServicio;
use App\Models\UnidadMedica;
use App\Models\DirectorioItem;
use App\Models\RemtysCard;
use App\Models\DocumentoInicio;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Schema;

class PageController extends Controller
{
    public function inicio()
    {
        $slides    = Carrusel::activos()->get();
        $boletines = Boletin::activos()->take(3)->get();

        $documentosInicio = DocumentoInicio::activos()
            ->orderBy('orden')
            ->orderBy('id')
            ->get();

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

        return view('pages.inicio', compact('slides', 'boletines', 'areasAtencion', 'serviciosSalud', 'documentosInicio'));
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
        $categoriasServicios = collect();
        $serviciosPorCategoria = collect();

        if (Schema::hasTable('servicio_categorias')) {
            $categoriasServicios = ServicioCategoria::activas()->get();
        }
        if (Schema::hasTable('servicio_seccion_items')) {
            $serviciosPorCategoria = ServicioSeccionItem::activos()->get()->groupBy('categoria');
        }

        if ($categoriasServicios->isEmpty() || $serviciosPorCategoria->isEmpty()) {
            $categoriasServicios = $this->categoriasServiciosPorDefecto();
            $serviciosPorCategoria = $this->serviciosPorCategoriaPorDefecto();
        }

        return view('pages.servicios', compact('serviciosPorCategoria', 'categoriasServicios'));
    }

    public function salud()
    {
        $saludServicios = collect();
        if (Schema::hasTable('salud_servicios')) {
            $saludServicios = SaludServicio::activos()->get();
        }
        if ($saludServicios->isEmpty()) {
            $saludServicios = $this->saludServiciosPorDefecto();
        }

        $unidadesMedicas = collect();
        if (Schema::hasTable('unidades_medicas')) {
            $unidadesMedicas = UnidadMedica::activas()->get();
        }
        if ($unidadesMedicas->isEmpty()) {
            $unidadesMedicas = $this->unidadesMedicasPorDefecto();
        }

        return view('pages.salud', compact('saludServicios', 'unidadesMedicas'));
    }
    private function categoriasServiciosPorDefecto(): Collection
    {
        return collect([
            (object) ['clave' => 'bienestar_social', 'nombre' => 'Bienestar Social', 'subtitulo' => 'Programas de apoyo a la comunidad', 'icono' => 'fa-hand-holding-heart', 'tema' => 'pink'],
            (object) ['clave' => 'derechos', 'nombre' => 'Atencion y Defensa de Derechos', 'subtitulo' => 'Mujeres, juventud y diversidad sexual', 'icono' => 'fa-shield-heart', 'tema' => 'purple'],
            (object) ['clave' => 'salud', 'nombre' => 'Salud', 'subtitulo' => 'Atencion medica integral', 'icono' => 'fa-heartbeat', 'tema' => 'red'],
            (object) ['clave' => 'educacion_cultura', 'nombre' => 'Educacion y Cultura', 'subtitulo' => 'Aprendizaje y desarrollo cultural', 'icono' => 'fa-book-open', 'tema' => 'blue'],
            (object) ['clave' => 'juridico', 'nombre' => 'Juridico', 'subtitulo' => 'Asesoria legal gratuita', 'icono' => 'fa-scale-balanced', 'tema' => 'amber'],
        ]);
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
        $directorioItems = collect();
        if (Schema::hasTable('directorio_items')) {
            $directorioItems = DirectorioItem::activos()->get();
        }
        if ($directorioItems->isEmpty()) {
            $directorioItems = $this->directorioPorDefecto();
        }

        return view('pages.directorio', compact('directorioItems'));
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

    public function remtys(Request $request)
    {
        $remtysCards = collect();
        if (Schema::hasTable('remtys_cards') && Schema::hasTable('remtys_documentos')) {
            $remtysCards = RemtysCard::activas()->with(['documentos' => fn ($q) => $q->where('activo', true)->orderBy('orden')->orderBy('id')])->get();
        }
        if ($remtysCards->isEmpty()) {
            $remtysCards = $this->remtysPorDefecto();
        }

        $categoriaId = $request->query('categoria');
        $remtysCategoriaSeleccionada = $remtysCards->firstWhere('id', (int) $categoriaId) ?: $remtysCards->first();

        return view('pages.remtys', compact('remtysCards', 'remtysCategoriaSeleccionada'));
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

    private function saludServiciosPorDefecto(): Collection
    {
        return collect([
            (object) ['nombre' => 'Consulta medica', 'icono' => 'fa-user-doctor', 'color_gradiente' => 'from-dif-pink to-dif-magenta'],
            (object) ['nombre' => 'Terapia psicologica', 'icono' => 'fa-brain', 'color_gradiente' => 'from-purple-600 to-purple-400'],
            (object) ['nombre' => 'Consulta nutricional', 'icono' => 'fa-apple-whole', 'color_gradiente' => 'from-green-600 to-green-400'],
            (object) ['nombre' => 'Consulta dental', 'icono' => 'fa-tooth', 'color_gradiente' => 'from-blue-500 to-blue-400'],
            (object) ['nombre' => 'Consulta ginecologia', 'icono' => 'fa-venus', 'color_gradiente' => 'from-pink-500 to-pink-400'],
            (object) ['nombre' => 'Consulta pediatra', 'icono' => 'fa-baby', 'color_gradiente' => 'from-cyan-500 to-cyan-400'],
            (object) ['nombre' => 'Terapia fisica', 'icono' => 'fa-person-walking', 'color_gradiente' => 'from-orange-500 to-orange-400'],
            (object) ['nombre' => 'Terapia ocupacional', 'icono' => 'fa-hands', 'color_gradiente' => 'from-teal-600 to-teal-400'],
            (object) ['nombre' => 'Terapia de lenguaje', 'icono' => 'fa-comments', 'color_gradiente' => 'from-indigo-500 to-indigo-400'],
            (object) ['nombre' => 'Equinoterapia', 'icono' => 'fa-horse', 'color_gradiente' => 'from-amber-600 to-amber-400'],
            (object) ['nombre' => 'Clase de monta', 'icono' => 'fa-horse-head', 'color_gradiente' => 'from-yellow-600 to-yellow-400'],
            (object) ['nombre' => 'Salud en tu hogar', 'icono' => 'fa-house-medical', 'color_gradiente' => 'from-red-500 to-red-400'],
            (object) ['nombre' => 'Certificado de discapacidad', 'icono' => 'fa-id-card', 'color_gradiente' => 'from-slate-600 to-slate-400'],
            (object) ['nombre' => 'Lengua de senas mexicana', 'icono' => 'fa-hands-asl-interpreting', 'color_gradiente' => 'from-violet-600 to-violet-400'],
            (object) ['nombre' => 'Lectura y escritura braille', 'icono' => 'fa-braille', 'color_gradiente' => 'from-stone-600 to-stone-400'],
            (object) ['nombre' => 'Curso de oftalmologia', 'icono' => 'fa-eye', 'color_gradiente' => 'from-sky-600 to-sky-400'],
        ]);
    }

    private function unidadesMedicasPorDefecto(): Collection
    {
        return collect([
            (object) [
                'nombre' => 'Unidad Medica Mandarinas',
                'subtitulo' => null,
                'direccion' => 'Fracc. Ojo de Agua, calle Mandarinas, esq. Naranjos, C.P. 55770',
                'icono' => 'fa-hospital',
                'tema' => 'pink',
                'imagen' => 'page1_img8.png',
                'horario_1' => 'Lunes a Viernes: 9:00 - 18:00 hrs',
                'horario_2' => 'Sabados: 9:00 - 13:00 hrs',
                'servicios' => ['Consulta medica', 'Terapia psicologica', 'Consulta Nutricion', 'Consulta Dental', 'Salud en tu hogar', 'Consulta ginecologia', 'Consulta pediatra', 'Curso de oftalmologia'],
            ],
            (object) [
                'nombre' => 'Centro de Equinoterapia',
                'subtitulo' => null,
                'direccion' => 'Carretera Federal Mexico - Pachuca, Km. 38, Sierra Hermosa, 55740',
                'icono' => 'fa-horse',
                'tema' => 'green',
                'imagen' => 'page1_img29.png',
                'horario_1' => 'Lunes a Viernes: 9:00 - 15:00 hrs',
                'horario_2' => null,
                'servicios' => ['Equinoterapia', 'Clase de monta', 'Terapia psicologica', 'Terapia de lenguaje', 'Lengua de senas mexicanas', 'Lectura y escritura de braille'],
            ],
            (object) [
                'nombre' => 'Clinica Materno Infantil',
                'subtitulo' => 'Juana Belen Gutierrez de Mendoza',
                'direccion' => 'Av. Esmeralda S/N colonia Lomas de Tecamac, Tecamac, Mex.',
                'icono' => 'fa-baby',
                'tema' => 'blue',
                'imagen' => 'page1_img38.png',
                'horario_1' => 'Lunes a Viernes: 9:00 - 18:00 hrs',
                'horario_2' => null,
                'servicios' => ['Consulta medica', 'Terapia psicologica', 'Consulta nutricional', 'Consulta dental', 'Consulta ginecologia', 'Consulta pediatra', 'Curso de oftalmologia'],
            ],
            (object) [
                'nombre' => 'U.B.R.I.S',
                'subtitulo' => 'Unidad Basica de Rehabilitacion e Integracion Social',
                'direccion' => 'Mandarinas S/N Esq. Naranjos, Col. Fracc. Ojo de Agua, C.P. 55770',
                'icono' => 'fa-wheelchair',
                'tema' => 'purple',
                'imagen' => 'page1_img37.png',
                'horario_1' => 'Lunes a Viernes: 9:00 - 15:00 hrs',
                'horario_2' => null,
                'servicios' => ['Consulta con medico especialista en rehabilitacion', 'Certificado de discapacidad', 'Terapia fisica', 'Terapia ocupacional', 'Terapia psicologica', 'Terapia de lenguaje', 'Curso de lengua de senas mexicana', 'Curso lectura y escritura de braille'],
            ],
            (object) [
                'nombre' => 'Unidad Medica Reyes Acozac',
                'subtitulo' => null,
                'direccion' => 'C. Ninos Heroes No. 14, Barrio el Calvario, Pueblo de los Reyes Acozac, C.P. 55755',
                'icono' => 'fa-stethoscope',
                'tema' => 'teal',
                'imagen' => 'page1_img11.png',
                'horario_1' => 'Lunes a Viernes: 9:00 - 18:00 hrs',
                'horario_2' => null,
                'servicios' => ['Consulta medica', 'Terapia psicologica', 'Consulta Nutricion', 'Consulta Dental', 'Terapia Fisica', 'Curso de lengua de senas mexicana', 'Curso lectura y escritura de braille'],
            ],
            (object) [
                'nombre' => 'Laboratorio de Analisis Clinicos',
                'subtitulo' => null,
                'direccion' => null,
                'icono' => 'fa-flask',
                'tema' => 'amber',
                'imagen' => 'page1_img21.png',
                'horario_1' => 'Lunes a Viernes: 9:00 - 15:00 hrs',
                'horario_2' => null,
                'servicios' => ['Quimica sanguinea de 25 elementos', 'Examen General de Orina', 'Biometria Hematica', 'Paquete promocion (QS 25, EGO, BH)', 'Prueba de antigeno prostatico', 'Prueba de embarazo', 'Prueba de antidoping', 'Grupo sanguineo y factor RH', 'VSG'],
            ],
        ]);
    }

    private function directorioPorDefecto(): Collection
    {
        return collect([
            (object) [
                'nombre' => 'Oficinas Centrales DIF Villas del Real',
                'direccion' => 'Av. Esmeralda S/N colonia Lomas de Tecamac, Tecamac, Mex.',
                'horario' => 'Lunes a Viernes: 9:00 - 18:00 hrs',
                'icono' => 'fa-building',
                'color_gradiente' => 'from-dif-pink to-dif-magenta',
                'servicios' => ['Atencion ciudadana', 'Informacion general', 'Tramites administrativos'],
            ],
            (object) [
                'nombre' => 'Unidad Medica Mandarinas',
                'direccion' => 'Fracc. Ojo de Agua, calle Mandarinas, esq. Naranjos, C.P. 55770',
                'horario' => 'Lunes a Viernes: 9:00 - 18:00 hrs | Sabados: 9:00 - 13:00 hrs',
                'icono' => 'fa-hospital',
                'color_gradiente' => 'from-dif-pink to-dif-pink-light',
                'servicios' => ['Consulta medica', 'Terapia psicologica', 'Consulta Nutricion', 'Consulta Dental', 'Salud en tu hogar'],
            ],
            (object) [
                'nombre' => 'Centro de Equinoterapia',
                'direccion' => 'Carretera Federal Mexico - Pachuca, Km. 38, Sierra Hermosa, 55740 Tecamac',
                'horario' => 'Lunes a Viernes: 9:00 - 15:00 hrs',
                'icono' => 'fa-horse',
                'color_gradiente' => 'from-green-700 to-green-500',
                'servicios' => ['Equinoterapia', 'Clase de monta', 'Terapia psicologica', 'Terapia de lenguaje', 'Lengua de senas mexicanas'],
            ],
            (object) [
                'nombre' => 'Clinica Materno Infantil Juana Belen Gutierrez de Mendoza',
                'direccion' => 'Av. Esmeralda S/N colonia Lomas de Tecamac, Tecamac, Mex.',
                'horario' => 'Lunes a Viernes: 9:00 - 18:00 hrs',
                'icono' => 'fa-baby',
                'color_gradiente' => 'from-blue-700 to-blue-500',
                'servicios' => ['Consulta medica', 'Terapia psicologica', 'Consulta nutricional', 'Consulta dental', 'Ginecologia', 'Pediatra'],
            ],
            (object) [
                'nombre' => 'U.B.R.I.S',
                'direccion' => 'Mandarinas S/N Esq. Naranjos, Col. Fracc. Ojo de Agua, C.P. 55770',
                'horario' => 'Lunes a Viernes: 9:00 - 15:00 hrs',
                'icono' => 'fa-wheelchair',
                'color_gradiente' => 'from-purple-700 to-purple-500',
                'servicios' => ['Medico especialista en rehabilitacion', 'Certificado de discapacidad', 'Terapia fisica', 'Terapia ocupacional', 'Terapia de lenguaje', 'Braille'],
            ],
            (object) [
                'nombre' => 'Unidad Medica Reyes Acozac',
                'direccion' => 'C. Ninos Heroes No. 14, Barrio el Calvario, Pueblo de los Reyes Acozac, C.P. 55755',
                'horario' => 'Lunes a Viernes: 9:00 - 18:00 hrs',
                'icono' => 'fa-stethoscope',
                'color_gradiente' => 'from-teal-700 to-teal-500',
                'servicios' => ['Consulta medica', 'Terapia psicologica', 'Consulta Nutricion', 'Consulta Dental', 'Terapia Fisica'],
            ],
            (object) [
                'nombre' => 'Laboratorio de Analisis Clinicos',
                'direccion' => 'Fracc. Ojo de Agua, calle Mandarinas, esq. Naranjos, C.P. 55770',
                'horario' => 'Lunes a Viernes: 9:00 - 15:00 hrs',
                'icono' => 'fa-flask',
                'color_gradiente' => 'from-amber-700 to-amber-500',
                'servicios' => ['Quimica sanguinea 25 elementos', 'Examen General de Orina', 'Biometria Hematica', 'Antigeno prostatico', 'Prueba de embarazo'],
            ],
            (object) [
                'nombre' => 'Centro de Diversidad Los Heroes Tecamac',
                'direccion' => 'Col. Heroes de Tecamac, Ojo de Agua, Mex.',
                'horario' => 'Lunes a Viernes: 9:00 - 15:00 hrs',
                'icono' => 'fa-people-group',
                'color_gradiente' => 'from-indigo-700 to-indigo-500',
                'servicios' => ['Atencion a la diversidad', 'Asesoria psicologica', 'Programas de inclusion'],
            ],
        ]);
    }

    private function remtysPorDefecto(): Collection
    {
        return collect([
            (object) [
                'nombre' => 'Consejeria Juridica',
                'icono' => 'fa-gavel',
                'color_gradiente' => 'from-purple-700/80 to-purple-500/80',
                'documentos' => collect([
                    (object) ['titulo' => 'Lineamientos de asesoria juridica', 'archivo' => null, 'url' => '/pdf/pada.pdf'],
                ]),
            ],
            (object) [
                'nombre' => 'Tesoreria Municipal',
                'icono' => 'fa-coins',
                'color_gradiente' => 'from-red-700/80 to-red-500/80',
                'documentos' => collect([
                    (object) ['titulo' => 'Formato de tramites de tesoreria', 'archivo' => null, 'url' => '/pdf/programa.pdf'],
                ]),
            ],
            (object) [
                'nombre' => 'Organo Interno de Control Municipal',
                'icono' => 'fa-building-shield',
                'color_gradiente' => 'from-blue-700/80 to-blue-500/80',
                'documentos' => collect([
                    (object) ['titulo' => 'Guia de procedimientos de control interno', 'archivo' => null, 'url' => '/pdf/pada.pdf'],
                ]),
            ],
        ]);
    }
}
