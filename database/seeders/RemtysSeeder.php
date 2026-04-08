<?php

namespace Database\Seeders;

use App\Models\RemtysCard;
use App\Models\RemtysDocumento;
use Illuminate\Database\Seeder;

class RemtysSeeder extends Seeder
{
    public function run(): void
    {
        $cards = [
            ['nombre' => 'Consejeria Juridica', 'icono' => 'fa-gavel', 'color_gradiente' => 'from-purple-700/80 to-purple-500/80', 'orden' => 1],
            ['nombre' => 'Tesoreria Municipal', 'icono' => 'fa-coins', 'color_gradiente' => 'from-red-700/80 to-red-500/80', 'orden' => 2],
            ['nombre' => 'Organo Interno de Control Municipal', 'icono' => 'fa-building-shield', 'color_gradiente' => 'from-blue-700/80 to-blue-500/80', 'orden' => 3],
        ];

        $cardsByName = [];
        foreach ($cards as $cardData) {
            $card = RemtysCard::updateOrCreate(['nombre' => $cardData['nombre']], $cardData + ['activo' => true]);
            $cardsByName[$cardData['nombre']] = $card;
        }

        $docs = [
            ['card' => 'Consejeria Juridica', 'titulo' => 'Lineamientos de asesoria juridica', 'url' => '/pdf/pada.pdf', 'orden' => 1],
            ['card' => 'Tesoreria Municipal', 'titulo' => 'Formato de tramites de tesoreria', 'url' => '/pdf/programa.pdf', 'orden' => 1],
            ['card' => 'Organo Interno de Control Municipal', 'titulo' => 'Guia de procedimientos de control interno', 'url' => '/pdf/pada.pdf', 'orden' => 1],
        ];

        foreach ($docs as $docData) {
            $card = $cardsByName[$docData['card']] ?? null;
            if (!$card) {
                continue;
            }

            RemtysDocumento::updateOrCreate(
                ['remtys_card_id' => $card->id, 'titulo' => $docData['titulo']],
                [
                    'archivo' => null,
                    'url' => $docData['url'],
                    'orden' => $docData['orden'],
                    'activo' => true,
                ]
            );
        }
    }
}
