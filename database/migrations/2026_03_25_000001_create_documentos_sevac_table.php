<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('documentos_sevac', function (Blueprint $table) {
            $table->id();
            $table->year('anio');                          // 2018, 2019 … 2024
            $table->string('categoria');                   // "CONAC TÍTULO IV — 1er Trimestre 2024"
            $table->string('nombre');                      // "Endeudamiento Neto"
            $table->string('archivo')->nullable();         // PDF subido: sevac/2024/archivo.pdf
            $table->string('link_externo')->nullable();    // URL de Google Drive u otro
            $table->unsignedInteger('orden')->default(0);
            $table->boolean('activo')->default(true);
            $table->timestamps();

            $table->index('anio');
            $table->index(['anio', 'categoria']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('documentos_sevac');
    }
};
