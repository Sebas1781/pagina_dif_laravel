<?php

namespace Database\Seeders;

use App\Models\CasaCultura;
use App\Models\Biblioteca;
use App\Models\EstanciaInfantil;
use App\Models\EventoCultural;
use Illuminate\Database\Seeder;

class EducacionSeeder extends Seeder
{
    public function run(): void
    {
        // ── Casas de Cultura ──────────────────────────────────────
        $casas = [
            ['nombre' => 'Casa de Cultura, Tecámac Centro',           'direccion' => 'Av. 5 de Mayo 46, Tecámac Centro, 55740 Tecámac de Felipe Villanueva, Méx.',              'icono' => 'fa-landmark',       'color_gradiente' => 'from-dif-pink to-dif-magenta',   'imagen' => 'page2_img14.png', 'orden' => 1],
            ['nombre' => 'Casa de Cultura, Los Reyes Acozac',         'direccion' => 'Av. Sanchez Colín, Tlalzompa Manzana 036, Reyes Acozac, 55755 Los Reyes Acozac, Méx.',   'icono' => 'fa-palette',        'color_gradiente' => 'from-purple-600 to-purple-400',  'imagen' => 'page1_img3.png',  'orden' => 2],
            ['nombre' => 'Casa de Cultura, San Pedro Pozohuacan',     'direccion' => 'Manzana 013, Centro, San Pedro Pozohuacan, 55744 Santa María Ajoloapan, Méx.',            'icono' => 'fa-masks-theater',  'color_gradiente' => 'from-blue-600 to-blue-400',      'imagen' => 'sp_pozo.jpg',     'orden' => 3],
            ['nombre' => 'Casa de Cultura, Geo Sierra Hermosa',       'direccion' => 'Rancho Grande, Sierra Hermosa, 55749 Ojo de Agua, Méx.',                                  'icono' => 'fa-music',          'color_gradiente' => 'from-indigo-600 to-indigo-400',  'imagen' => 'geo_sierra.jpg',  'orden' => 4],
            ['nombre' => 'Casa de Cultura, Héroes Tecámac',           'direccion' => 'Manzana 022, Col. Héroes de Tecámac, 55763 Ojo de Agua, Méx.',                           'icono' => 'fa-guitar',         'color_gradiente' => 'from-teal-600 to-teal-400',      'imagen' => 'heroes_tecamac.jpg', 'orden' => 5],
            ['nombre' => 'Casa de Cultura, San Jerónimo Xonacahuacan','direccion' => 'Manzana 029, San Jerónimo Xonacahuacan, 55745 Santa María Ajoloapan, Méx.',              'icono' => 'fa-paintbrush',     'color_gradiente' => 'from-rose-600 to-rose-400',      'imagen' => 'page2_img2.png',  'orden' => 6],
        ];

        foreach ($casas as $data) {
            CasaCultura::updateOrCreate(['nombre' => $data['nombre']], $data + ['activo' => true]);
        }

        // ── Bibliotecas ───────────────────────────────────────────
        $bibliotecas = [
            'Felipe Villanueva', 'San Lucas Xolox', 'Nezahualcóyotl', 'Los Héroes Tecámac',
            'Acozahuac', 'Amado Nervo', 'Ángeles Mastretta', 'Santa Cruz',
            'Benito Juárez', 'Ricardo Flores Magón', 'Haciendas Del Bosque',
            'Sor Juana Inés De La Cruz', 'Joaquín Fernández De Lizardi',
        ];

        foreach ($bibliotecas as $i => $nombre) {
            Biblioteca::updateOrCreate(['nombre' => 'Biblioteca ' . $nombre], [
                'nombre' => 'Biblioteca ' . $nombre,
                'orden'  => $i + 1,
                'activo' => true,
            ]);
        }

        // ── Estancias Infantiles ──────────────────────────────────
        $estancias = [
            ['nombre' => 'Estancia Infantil "Paola Espinoza"',              'icono' => 'fa-baby',                'color_gradiente' => 'from-pink-500 to-pink-400',   'orden' => 1],
            ['nombre' => 'Estancia Infantil "Juan Pablo II"',               'icono' => 'fa-child-reaching',      'color_gradiente' => 'from-blue-500 to-blue-400',   'orden' => 2],
            ['nombre' => 'Estancia Infantil "Los Héroes Tecámac"',          'icono' => 'fa-children',            'color_gradiente' => 'from-green-500 to-green-400', 'orden' => 3],
            ['nombre' => 'Estancia Infantil "Hellen Keller"',               'icono' => 'fa-hands-holding-child', 'color_gradiente' => 'from-purple-500 to-purple-400','orden' => 4],
            ['nombre' => 'Estancia Infantil "Leona Vicario"',               'icono' => 'fa-child-dress',         'color_gradiente' => 'from-amber-500 to-amber-400', 'orden' => 5],
            ['nombre' => 'Estancia Infantil "Sor Juana Inés de la Cruz"',   'icono' => 'fa-school',              'color_gradiente' => 'from-teal-500 to-teal-400',   'orden' => 6],
            ['nombre' => 'Preescolar "Laura Méndez de Cuenca"',             'icono' => 'fa-graduation-cap',      'color_gradiente' => 'from-indigo-500 to-indigo-400','orden' => 7],
        ];

        foreach ($estancias as $data) {
            EstanciaInfantil::updateOrCreate(['nombre' => $data['nombre']], $data + ['activo' => true]);
        }

        // ── Eventos Culturales ────────────────────────────────────
        $eventos = [
            ['titulo' => 'Orquesta Filarmónica Municipal', 'subtitulo' => '"Ilustre Músico Tecamaquense"', 'descripcion' => 'Conoce toda la información que necesitas para hacer uso de estos servicios culturales.', 'imagen' => 'page2_img3.png',  'orden' => 1],
            ['titulo' => 'Festival Atmósfera 2025',        'subtitulo' => null,                            'descripcion' => 'Evento cultural y artístico que reúne a la comunidad tecamaquense en un espacio de convivencia y entretenimiento.', 'imagen' => 'page2_img11.png', 'orden' => 2],
            ['titulo' => 'Feria Regional de Tecámac',      'subtitulo' => null,                            'descripcion' => 'La celebración más importante del municipio con actividades culturales, artísticas y recreativas para toda la familia.', 'imagen' => 'page2_img12.png', 'orden' => 3],
        ];

        foreach ($eventos as $data) {
            EventoCultural::updateOrCreate(['titulo' => $data['titulo']], $data + ['activo' => true]);
        }
    }
}
