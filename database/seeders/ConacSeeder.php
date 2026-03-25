<?php

namespace Database\Seeders;

use App\Models\DocumentoConac;
use Illuminate\Database\Seeder;

class ConacSeeder extends Seeder
{
    /**
     * Extrae del sevac.json las categorías cuyo nombre empiece con "CONAC" o "LGCG"
     * y las importa en la tabla documentos_conac.
     */
    public function run(): void
    {
        $jsonPath = resource_path('data/sevac.json');
        $data     = json_decode(file_get_contents($jsonPath), true);

        DocumentoConac::truncate();

        $total = 0;

        foreach ($data as $anio => $categorias) {
            $orden = 1;
            foreach ($categorias as $categoria => $documentos) {
                // Solo importar categorías CONAC / LGCG
                if (!str_starts_with($categoria, 'CONAC') && !str_starts_with($categoria, 'LGCG')) {
                    continue;
                }

                foreach ($documentos as $doc) {
                    DocumentoConac::create([
                        'anio'         => (int) $anio,
                        'categoria'    => $categoria,
                        'nombre'       => $doc[0],
                        'link_externo' => $doc[1],
                        'orden'        => $orden++,
                        'activo'       => true,
                    ]);
                    $total++;
                }
            }
        }

        $this->command->info("✓ Se importaron {$total} documentos CONAC desde el JSON.");
    }
}
