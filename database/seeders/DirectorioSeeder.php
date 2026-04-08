<?php

namespace Database\Seeders;

use App\Models\DirectorioItem;
use Illuminate\Database\Seeder;

class DirectorioSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            [
                'nombre' => 'Oficinas Centrales DIF Villas del Real',
                'direccion' => 'Av. Esmeralda S/N colonia Lomas de Tecamac, Tecamac, Mex.',
                'horario' => 'Lunes a Viernes: 9:00 - 18:00 hrs',
                'icono' => 'fa-building',
                'color_gradiente' => 'from-dif-pink to-dif-magenta',
                'servicios' => ['Atencion ciudadana', 'Informacion general', 'Tramites administrativos'],
                'orden' => 1,
            ],
            [
                'nombre' => 'Unidad Medica Mandarinas',
                'direccion' => 'Fracc. Ojo de Agua, calle Mandarinas, esq. Naranjos, C.P. 55770',
                'horario' => 'Lunes a Viernes: 9:00 - 18:00 hrs | Sabados: 9:00 - 13:00 hrs',
                'icono' => 'fa-hospital',
                'color_gradiente' => 'from-dif-pink to-dif-pink-light',
                'servicios' => ['Consulta medica', 'Terapia psicologica', 'Consulta Nutricion', 'Consulta Dental', 'Salud en tu hogar'],
                'orden' => 2,
            ],
            [
                'nombre' => 'Centro de Equinoterapia',
                'direccion' => 'Carretera Federal Mexico - Pachuca, Km. 38, Sierra Hermosa, 55740 Tecamac',
                'horario' => 'Lunes a Viernes: 9:00 - 15:00 hrs',
                'icono' => 'fa-horse',
                'color_gradiente' => 'from-green-700 to-green-500',
                'servicios' => ['Equinoterapia', 'Clase de monta', 'Terapia psicologica', 'Terapia de lenguaje', 'Lengua de senas mexicanas'],
                'orden' => 3,
            ],
            [
                'nombre' => 'Clinica Materno Infantil Juana Belen Gutierrez de Mendoza',
                'direccion' => 'Av. Esmeralda S/N colonia Lomas de Tecamac, Tecamac, Mex.',
                'horario' => 'Lunes a Viernes: 9:00 - 18:00 hrs',
                'icono' => 'fa-baby',
                'color_gradiente' => 'from-blue-700 to-blue-500',
                'servicios' => ['Consulta medica', 'Terapia psicologica', 'Consulta nutricional', 'Consulta dental', 'Ginecologia', 'Pediatra'],
                'orden' => 4,
            ],
            [
                'nombre' => 'U.B.R.I.S',
                'direccion' => 'Mandarinas S/N Esq. Naranjos, Col. Fracc. Ojo de Agua, C.P. 55770',
                'horario' => 'Lunes a Viernes: 9:00 - 15:00 hrs',
                'icono' => 'fa-wheelchair',
                'color_gradiente' => 'from-purple-700 to-purple-500',
                'servicios' => ['Medico especialista en rehabilitacion', 'Certificado de discapacidad', 'Terapia fisica', 'Terapia ocupacional', 'Terapia de lenguaje', 'Braille'],
                'orden' => 5,
            ],
            [
                'nombre' => 'Unidad Medica Reyes Acozac',
                'direccion' => 'C. Ninos Heroes No. 14, Barrio el Calvario, Pueblo de los Reyes Acozac, C.P. 55755',
                'horario' => 'Lunes a Viernes: 9:00 - 18:00 hrs',
                'icono' => 'fa-stethoscope',
                'color_gradiente' => 'from-teal-700 to-teal-500',
                'servicios' => ['Consulta medica', 'Terapia psicologica', 'Consulta Nutricion', 'Consulta Dental', 'Terapia Fisica'],
                'orden' => 6,
            ],
            [
                'nombre' => 'Laboratorio de Analisis Clinicos',
                'direccion' => 'Fracc. Ojo de Agua, calle Mandarinas, esq. Naranjos, C.P. 55770',
                'horario' => 'Lunes a Viernes: 9:00 - 15:00 hrs',
                'icono' => 'fa-flask',
                'color_gradiente' => 'from-amber-700 to-amber-500',
                'servicios' => ['Quimica sanguinea 25 elementos', 'Examen General de Orina', 'Biometria Hematica', 'Antigeno prostatico', 'Prueba de embarazo'],
                'orden' => 7,
            ],
            [
                'nombre' => 'Centro de Diversidad Los Heroes Tecamac',
                'direccion' => 'Col. Heroes de Tecamac, Ojo de Agua, Mex.',
                'horario' => 'Lunes a Viernes: 9:00 - 15:00 hrs',
                'icono' => 'fa-people-group',
                'color_gradiente' => 'from-indigo-700 to-indigo-500',
                'servicios' => ['Atencion a la diversidad', 'Asesoria psicologica', 'Programas de inclusion'],
                'orden' => 8,
            ],
        ];

        foreach ($items as $item) {
            DirectorioItem::updateOrCreate(['nombre' => $item['nombre']], $item + ['activo' => true]);
        }
    }
}
