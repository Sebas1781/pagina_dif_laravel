<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('documentos_presupuesto', function (Blueprint $table) {
            $table->id();
            $table->unsignedSmallInteger('anio')->index();
            $table->string('categoria');
            $table->string('nombre');
            $table->string('archivo')->nullable();
            $table->string('link_externo', 500)->nullable();
            $table->unsignedInteger('orden')->default(0);
            $table->boolean('activo')->default(true);
            $table->timestamps();

            $table->index(['anio', 'categoria']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('documentos_presupuesto');
    }
};
