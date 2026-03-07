<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('estancias_infantiles', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('icono')->default('fa-baby');
            $table->string('color_gradiente')->default('from-pink-500 to-pink-400');
            $table->boolean('activo')->default(true);
            $table->unsignedSmallInteger('orden')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('estancias_infantiles');
    }
};
