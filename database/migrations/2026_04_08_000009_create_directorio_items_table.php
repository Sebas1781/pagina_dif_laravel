<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('directorio_items', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->text('direccion')->nullable();
            $table->string('horario')->nullable();
            $table->string('icono')->default('fa-building');
            $table->string('color_gradiente')->default('from-dif-pink to-dif-magenta');
            $table->json('servicios')->nullable();
            $table->boolean('activo')->default(true);
            $table->unsignedSmallInteger('orden')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('directorio_items');
    }
};
