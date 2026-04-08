<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // Seeder de usuario de prueba
        User::firstOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'password' => bcrypt('password'),
            ]
        );

        // Ejecutar seeders personalizados
        $this->call([
            AdminSeeder::class,
            BoletinSeeder::class,
            EducacionSeeder::class,
            InicioCatalogosSeeder::class,
            ContenidoInstitucionalSeeder::class,
            SaludContenidoSeeder::class,
            DirectorioSeeder::class,
            RemtysSeeder::class,
        ]);
    }
}
