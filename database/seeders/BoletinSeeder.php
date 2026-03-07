<?php

namespace Database\Seeders;

use App\Models\Boletin;
use Illuminate\Database\Seeder;

class BoletinSeeder extends Seeder
{
    public function run(): void
    {
        $boletines = [
            [
                'titulo'      => 'Tardes de Serenata',
                'descripcion' => 'Tardes de Serenata en Tecámac nos regaló una jornada llena de sentimiento, donde el Mariachi Municipal "Orgullo de Tecámac" acompañó cada dedicatoria dada con el corazón.',
                'imagen'      => 'serenata.png',
                'orden'       => 1,
            ],
            [
                'titulo'      => 'Bodas Comunitarias 2026: Tecámac, Late por Ti',
                'descripcion' => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim.',
                'imagen'      => 'bodas.png',
                'orden'       => 2,
            ],
            [
                'titulo'      => 'Apoyo a Comunidades Escolares',
                'descripcion' => '"Apoyo a Comunidades Escolares", por instrucciones de nuestra Presidenta Municipal Rosi Wong, fortaleciendo así los espacios educativos y brindando mejores condiciones para nuestras niñas, niños y jóvenes.',
                'imagen'      => 'apoyo-comunidades.png',
                'orden'       => 3,
            ],
            [
                'titulo'      => 'Bienestar para los Hombres de Tecámac',
                'descripcion' => 'Por instrucciones de nuestra Presidenta Municipal, Rosi Wong llevamos a cabo la Jornada de Cuidado Integral del Hombre en el, acercando servicios de salud gratuitos a nuestra comunidad.',
                'imagen'      => 'bienestar.png',
                'orden'       => 4,
            ],
            [
                'titulo'      => 'Inauguración de Cursos y Talleres',
                'descripcion' => 'Con el compromiso de seguir construyendo un Tecámac incluyente y respetuoso, iniciamos nuestros cursos en los Centros de Atención Integral a la Diversidad Sexual.',
                'imagen'      => 'cursos.png',
                'orden'       => 5,
            ],
            [
                'titulo'      => 'Atmósfera Mundialista 2026',
                'descripcion' => 'Estamos a menos de un mes de iniciar este gran festival, no te lo puedes perder. ¡Atmósfera Mundialista 2026!',
                'imagen'      => 'atmosfera.png',
                'orden'       => 6,
            ],
        ];

        foreach ($boletines as $data) {
            Boletin::updateOrCreate(['titulo' => $data['titulo']], $data + ['activo' => true]);
        }
    }
}
