<?php

namespace Database\Seeders;

use App\Models\DocumentoSevac;
use Illuminate\Database\Seeder;

class SevacSeeder extends Seeder
{
    /**
     * Lee el JSON existente y lo importa a la tabla documentos_sevac.
     * Se puede ejecutar varias veces sin duplicar (trunca la tabla primero).
     */
    public function run(): void
    {
        $jsonPath = resource_path('data/sevac.json');

        if (!file_exists($jsonPath)) {
            $this->command->warn('⚠ No se encontró resources/data/sevac.json — se omitió la importación.');
            return;
        }

        $data = json_decode(file_get_contents($jsonPath), true);

        if (!$data) {
            $this->command->error('✗ El archivo sevac.json no es un JSON válido.');
            return;
        }

        // Limpiar tabla antes de importar
        DocumentoSevac::truncate();

        $total = 0;

        foreach ($data as $anio => $secciones) {
            foreach ($secciones as $categoria => $documentos) {
                // Excluir categorías CONAC / LGCG — esas van en ConacSeeder
                if (str_starts_with($categoria, 'CONAC') || str_starts_with($categoria, 'LGCG')) {
                    continue;
                }

                foreach ($documentos as $orden => [$nombre, $url]) {
                    DocumentoSevac::create([
                        'anio'         => (int) $anio,
                        'categoria'    => $categoria,
                        'nombre'       => $nombre,
                        'link_externo' => $url,
                        'archivo'      => null,
                        'orden'        => $orden,
                        'activo'       => true,
                    ]);
                    $total++;
                }
            }
        }

        $this->command->info("✓ Se importaron {$total} documentos SEVAC desde el JSON.");
    }
}
