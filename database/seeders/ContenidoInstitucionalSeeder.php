<?php

namespace Database\Seeders;

use App\Models\ConfiguracionNosotros;
use App\Models\SedeDif;
use App\Models\ServicioSeccionItem;
use Illuminate\Database\Seeder;

class ContenidoInstitucionalSeeder extends Seeder
{
    public function run(): void
    {
        ConfiguracionNosotros::updateOrCreate(
            ['id' => 1],
            [
                'mision' => 'Ser una institucion que brinde atencion integral a las familias tecamaquenses, promoviendo el bienestar social, la salud, la educacion y la cultura, con un enfoque de derechos humanos e igualdad de genero, contribuyendo al desarrollo pleno de la comunidad.',
                'vision' => 'Consolidarnos como la institucion referente en el municipio de Tecamac en materia de desarrollo integral familiar, reconocida por su calidad en los servicios, innovacion en programas sociales y compromiso genuino con las necesidades de cada habitante.',
                'valores' => [
                    'Honestidad y transparencia',
                    'Respeto a la dignidad humana',
                    'Compromiso social',
                    'Igualdad e inclusion',
                    'Servicio con calidad y calidez',
                    'Solidaridad comunitaria',
                ],
            ]
        );

        $sedes = [
            ['nombre' => 'Oficinas Centrales DIF Villas del Real', 'icono' => 'fa-building', 'color' => 'dif-pink', 'orden' => 1],
            ['nombre' => 'Unidad Medica Mandarinas', 'icono' => 'fa-hospital', 'color' => 'dif-pink', 'orden' => 2],
            ['nombre' => 'Unidad Medica Los Reyes Acozac', 'icono' => 'fa-stethoscope', 'color' => 'teal-600', 'orden' => 3],
            ['nombre' => 'Centro de Equinoterapia', 'icono' => 'fa-horse', 'color' => 'green-600', 'orden' => 4],
            ['nombre' => 'Centro de Diversidad Los Heroes Tecamac', 'icono' => 'fa-people-group', 'color' => 'purple-600', 'orden' => 5],
            ['nombre' => 'Centro M.I.E.L Urbi Villas', 'icono' => 'fa-hand-holding-heart', 'color' => 'amber-600', 'orden' => 6],
            ['nombre' => 'Solidarios de Corazon', 'icono' => 'fa-heart', 'color' => 'red-500', 'orden' => 7],
            ['nombre' => 'U.B.R.I.S', 'icono' => 'fa-wheelchair', 'color' => 'blue-600', 'orden' => 8],
            ['nombre' => 'Laboratorio de Analisis Clinicos', 'icono' => 'fa-flask', 'color' => 'indigo-600', 'orden' => 9],
        ];

        foreach ($sedes as $sede) {
            SedeDif::updateOrCreate(['nombre' => $sede['nombre']], $sede + ['activo' => true]);
        }

        $itemsPorCategoria = [
            'bienestar_social' => [
                'Apoyos alimentarios',
                'Programas de asistencia social',
                'Atencion a grupos vulnerables',
                'Solidarios de Corazon',
                'Centro M.I.E.L Urbi Villas',
                'Comedores comunitarios',
            ],
            'derechos' => [
                'Atencion a mujeres victimas de violencia',
                'Asesoria psicologica',
                'Programas de equidad de genero',
                'Atencion a la diversidad sexual',
                'Programas para jovenes',
                'Centro de Diversidad Los Heroes',
            ],
            'salud' => [
                'Consulta medica general',
                'Terapia psicologica',
                'Consulta nutricional',
                'Consulta dental',
                'Consulta ginecologia',
                'Consulta pediatra',
                'Terapia fisica',
                'Equinoterapia',
                'Laboratorio de analisis clinicos',
            ],
            'educacion_cultura' => [
                'Casas de Cultura (6 sedes)',
                'Bibliotecas municipales (15+)',
                'Estancias infantiles (7 sedes)',
                'Eventos culturales',
                'Orquesta Filarmonica Municipal',
                'Servicio social y colaboraciones',
            ],
            'juridico' => [
                'Asesoria juridica familiar',
                'Mediacion y conciliacion',
                'Proteccion a la infancia',
                'Tramites de custodia y pension',
                'Atencion a adultos mayores',
                'Defensa de derechos',
            ],
        ];

        foreach ($itemsPorCategoria as $categoria => $items) {
            foreach ($items as $index => $nombre) {
                ServicioSeccionItem::updateOrCreate(
                    ['categoria' => $categoria, 'nombre' => $nombre],
                    ['orden' => $index + 1, 'activo' => true]
                );
            }
        }
    }
}
