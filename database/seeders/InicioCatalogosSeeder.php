<?php

namespace Database\Seeders;

use App\Models\AreaAtencion;
use App\Models\ServicioSalud;
use Illuminate\Database\Seeder;

class InicioCatalogosSeeder extends Seeder
{
    public function run(): void
    {
        $areas = [
            [
                'nombre' => 'Salud y Bienestar',
                'icono' => 'fa-stethoscope',
                'color_gradiente' => 'from-dif-pink to-dif-pink-light',
                'enlace' => '/salud',
                'orden' => 1,
            ],
            [
                'nombre' => 'Educacion y Cultura',
                'icono' => 'fa-book-open',
                'color_gradiente' => 'from-teal-500 to-teal-400',
                'enlace' => '/educacion',
                'orden' => 2,
            ],
            [
                'nombre' => 'Juridico',
                'icono' => 'fa-gavel',
                'color_gradiente' => 'from-purple-800 to-purple-600',
                'enlace' => '/servicios',
                'orden' => 3,
            ],
            [
                'nombre' => 'Centros de Atencion Integral a la Diversidad Sexual',
                'icono' => 'fa-heart',
                'color_gradiente' => 'from-rose-400 to-pink-300',
                'enlace' => null,
                'orden' => 4,
            ],
            [
                'nombre' => 'Centros de Desarrollo Juvenil',
                'icono' => 'fa-users',
                'color_gradiente' => 'from-amber-500 to-amber-400',
                'enlace' => null,
                'orden' => 5,
            ],
            [
                'nombre' => 'Puerta Violeta',
                'icono' => 'fa-door-open',
                'color_gradiente' => 'from-purple-700 to-purple-500',
                'enlace' => null,
                'orden' => 6,
            ],
        ];

        foreach ($areas as $data) {
            AreaAtencion::updateOrCreate(
                ['nombre' => $data['nombre']],
                $data + ['activo' => true]
            );
        }

        $servicios = [
            [
                'nombre' => 'Unidad Medica Mandarinas',
                'descripcion' => 'Fracc. Ojo de Agua, calle Mandarinas, esq. Naranjos, C.P. 55770',
                'horario' => 'Lun a Vie: 9:00 - 18:00 hrs | Sab: 9:00 - 13:00 hrs',
                'color_horario' => 'text-dif-pink',
                'imagen' => 'page1_img8.png',
                'orden' => 1,
            ],
            [
                'nombre' => 'Centro de Equinoterapia',
                'descripcion' => 'Carretera Federal Mexico - Pachuca, Km. 38, Sierra Hermosa, 55740',
                'horario' => 'Lunes a Viernes: 9:00 - 15:00 hrs',
                'color_horario' => 'text-green-600',
                'imagen' => 'page1_img29.png',
                'orden' => 2,
            ],
            [
                'nombre' => 'Clinica Materno Infantil',
                'descripcion' => 'Juana Belen Gutierrez de Mendoza',
                'horario' => 'Lunes a Viernes: 9:00 - 15:00 hrs',
                'color_horario' => 'text-blue-600',
                'imagen' => 'page1_img38.png',
                'orden' => 3,
            ],
            [
                'nombre' => 'U.B.R.I.S',
                'descripcion' => 'Unidad Basica de Rehabilitacion e Integracion Social',
                'horario' => 'Lunes a Viernes: 9:00 - 15:00 hrs',
                'color_horario' => 'text-purple-600',
                'imagen' => 'page1_img37.png',
                'orden' => 4,
            ],
            [
                'nombre' => 'Unidad Medica Reyes Acozac',
                'descripcion' => 'C. Ninos Heroes No. 14, Barrio el Calvario, Reyes Acozac, C.P. 55755',
                'horario' => 'Lun a Vie: 9:00 - 18:00 hrs',
                'color_horario' => 'text-teal-600',
                'imagen' => 'page1_img11.png',
                'orden' => 5,
            ],
            [
                'nombre' => 'Laboratorio de Analisis Clinicos',
                'descripcion' => 'Analisis clinicos y pruebas especializadas',
                'horario' => 'Lunes a Viernes: 9:00 - 15:00 hrs',
                'color_horario' => 'text-amber-600',
                'imagen' => 'page1_img21.png',
                'orden' => 6,
            ],
        ];

        foreach ($servicios as $data) {
            ServicioSalud::updateOrCreate(
                ['nombre' => $data['nombre']],
                $data + ['activo' => true]
            );
        }
    }
}
