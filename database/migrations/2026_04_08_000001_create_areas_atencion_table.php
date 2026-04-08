<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('areas_atencion', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('icono')->default('fa-stethoscope');
            $table->string('color_gradiente')->default('from-dif-pink to-dif-pink-light');
            $table->string('enlace')->nullable();
            $table->boolean('activo')->default(true);
            $table->unsignedSmallInteger('orden')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('areas_atencion');
    }
};
