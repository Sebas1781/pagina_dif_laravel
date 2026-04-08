<?php

namespace Database\Seeders;

use App\Models\SaludServicio;
use App\Models\UnidadMedica;
use Illuminate\Database\Seeder;

class SaludContenidoSeeder extends Seeder
{
    public function run(): void
    {
        $servicios = [
            ['nombre' => 'Consulta medica', 'icono' => 'fa-user-doctor', 'color_gradiente' => 'from-dif-pink to-dif-magenta', 'orden' => 1],
            ['nombre' => 'Terapia psicologica', 'icono' => 'fa-brain', 'color_gradiente' => 'from-purple-600 to-purple-400', 'orden' => 2],
            ['nombre' => 'Consulta nutricional', 'icono' => 'fa-apple-whole', 'color_gradiente' => 'from-green-600 to-green-400', 'orden' => 3],
            ['nombre' => 'Consulta dental', 'icono' => 'fa-tooth', 'color_gradiente' => 'from-blue-500 to-blue-400', 'orden' => 4],
            ['nombre' => 'Consulta ginecologia', 'icono' => 'fa-venus', 'color_gradiente' => 'from-pink-500 to-pink-400', 'orden' => 5],
            ['nombre' => 'Consulta pediatra', 'icono' => 'fa-baby', 'color_gradiente' => 'from-cyan-500 to-cyan-400', 'orden' => 6],
            ['nombre' => 'Terapia fisica', 'icono' => 'fa-person-walking', 'color_gradiente' => 'from-orange-500 to-orange-400', 'orden' => 7],
            ['nombre' => 'Terapia ocupacional', 'icono' => 'fa-hands', 'color_gradiente' => 'from-teal-600 to-teal-400', 'orden' => 8],
            ['nombre' => 'Terapia de lenguaje', 'icono' => 'fa-comments', 'color_gradiente' => 'from-indigo-500 to-indigo-400', 'orden' => 9],
            ['nombre' => 'Equinoterapia', 'icono' => 'fa-horse', 'color_gradiente' => 'from-amber-600 to-amber-400', 'orden' => 10],
            ['nombre' => 'Clase de monta', 'icono' => 'fa-horse-head', 'color_gradiente' => 'from-yellow-600 to-yellow-400', 'orden' => 11],
            ['nombre' => 'Salud en tu hogar', 'icono' => 'fa-house-medical', 'color_gradiente' => 'from-red-500 to-red-400', 'orden' => 12],
            ['nombre' => 'Certificado de discapacidad', 'icono' => 'fa-id-card', 'color_gradiente' => 'from-slate-600 to-slate-400', 'orden' => 13],
            ['nombre' => 'Lengua de senas mexicana', 'icono' => 'fa-hands-asl-interpreting', 'color_gradiente' => 'from-violet-600 to-violet-400', 'orden' => 14],
            ['nombre' => 'Lectura y escritura braille', 'icono' => 'fa-braille', 'color_gradiente' => 'from-stone-600 to-stone-400', 'orden' => 15],
            ['nombre' => 'Curso de oftalmologia', 'icono' => 'fa-eye', 'color_gradiente' => 'from-sky-600 to-sky-400', 'orden' => 16],
        ];

        foreach ($servicios as $servicio) {
            SaludServicio::updateOrCreate(['nombre' => $servicio['nombre']], $servicio + ['activo' => true]);
        }

        $unidades = [
            [
                'nombre' => 'Unidad Medica Mandarinas',
                'direccion' => 'Fracc. Ojo de Agua, calle Mandarinas, esq. Naranjos, C.P. 55770',
                'icono' => 'fa-hospital',
                'tema' => 'pink',
                'imagen' => 'page1_img8.png',
                'horario_1' => 'Lunes a Viernes: 9:00 - 18:00 hrs',
                'horario_2' => 'Sabados: 9:00 - 13:00 hrs',
                'servicios' => ['Consulta medica', 'Terapia psicologica', 'Consulta Nutricion', 'Consulta Dental', 'Salud en tu hogar', 'Consulta ginecologia', 'Consulta pediatra', 'Curso de oftalmologia'],
                'orden' => 1,
            ],
            [
                'nombre' => 'Centro de Equinoterapia',
                'direccion' => 'Carretera Federal Mexico - Pachuca, Km. 38, Sierra Hermosa, 55740',
                'icono' => 'fa-horse',
                'tema' => 'green',
                'imagen' => 'page1_img29.png',
                'horario_1' => 'Lunes a Viernes: 9:00 - 15:00 hrs',
                'servicios' => ['Equinoterapia', 'Clase de monta', 'Terapia psicologica', 'Terapia de lenguaje', 'Lengua de senas mexicanas', 'Lectura y escritura de braille'],
                'orden' => 2,
            ],
            [
                'nombre' => 'Clinica Materno Infantil',
                'subtitulo' => 'Juana Belen Gutierrez de Mendoza',
                'direccion' => 'Av. Esmeralda S/N colonia Lomas de Tecamac, Tecamac, Mex.',
                'icono' => 'fa-baby',
                'tema' => 'blue',
                'imagen' => 'page1_img38.png',
                'horario_1' => 'Lunes a Viernes: 9:00 - 18:00 hrs',
                'servicios' => ['Consulta medica', 'Terapia psicologica', 'Consulta nutricional', 'Consulta dental', 'Consulta ginecologia', 'Consulta pediatra', 'Curso de oftalmologia'],
                'orden' => 3,
            ],
            [
                'nombre' => 'U.B.R.I.S',
                'subtitulo' => 'Unidad Basica de Rehabilitacion e Integracion Social',
                'direccion' => 'Mandarinas S/N Esq. Naranjos, Col. Fracc. Ojo de Agua, C.P. 55770',
                'icono' => 'fa-wheelchair',
                'tema' => 'purple',
                'imagen' => 'page1_img37.png',
                'horario_1' => 'Lunes a Viernes: 9:00 - 15:00 hrs',
                'servicios' => ['Consulta con medico especialista en rehabilitacion', 'Certificado de discapacidad', 'Terapia fisica', 'Terapia ocupacional', 'Terapia psicologica', 'Terapia de lenguaje', 'Curso de lengua de senas mexicana', 'Curso lectura y escritura de braille'],
                'orden' => 4,
            ],
            [
                'nombre' => 'Unidad Medica Reyes Acozac',
                'direccion' => 'C. Ninos Heroes No. 14, Barrio el Calvario, Pueblo de los Reyes Acozac, C.P. 55755',
                'icono' => 'fa-stethoscope',
                'tema' => 'teal',
                'imagen' => 'page1_img11.png',
                'horario_1' => 'Lunes a Viernes: 9:00 - 18:00 hrs',
                'servicios' => ['Consulta medica', 'Terapia psicologica', 'Consulta Nutricion', 'Consulta Dental', 'Terapia Fisica', 'Curso de lengua de senas mexicana', 'Curso lectura y escritura de braille'],
                'orden' => 5,
            ],
            [
                'nombre' => 'Laboratorio de Analisis Clinicos',
                'icono' => 'fa-flask',
                'tema' => 'amber',
                'imagen' => 'page1_img21.png',
                'horario_1' => 'Lunes a Viernes: 9:00 - 15:00 hrs',
                'servicios' => ['Quimica sanguinea de 25 elementos', 'Examen General de Orina', 'Biometria Hematica', 'Paquete promocion (QS 25, EGO, BH)', 'Prueba de antigeno prostatico', 'Prueba de embarazo', 'Prueba de antidoping', 'Grupo sanguineo y factor RH', 'VSG'],
                'orden' => 6,
            ],
        ];

        foreach ($unidades as $unidad) {
            UnidadMedica::updateOrCreate(['nombre' => $unidad['nombre']], $unidad + ['activo' => true]);
        }
    }
}
