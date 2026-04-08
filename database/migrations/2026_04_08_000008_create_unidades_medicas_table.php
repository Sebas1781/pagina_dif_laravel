<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('unidades_medicas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('subtitulo')->nullable();
            $table->text('direccion')->nullable();
            $table->string('icono')->default('fa-hospital');
            $table->string('tema')->default('pink');
            $table->string('imagen')->nullable();
            $table->string('horario_1')->nullable();
            $table->string('horario_2')->nullable();
            $table->json('servicios')->nullable();
            $table->boolean('activo')->default(true);
            $table->unsignedSmallInteger('orden')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('unidades_medicas');
    }
};
