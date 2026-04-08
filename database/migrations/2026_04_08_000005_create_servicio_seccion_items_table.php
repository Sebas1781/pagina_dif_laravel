<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('servicio_seccion_items', function (Blueprint $table) {
            $table->id();
            $table->string('categoria', 40);
            $table->string('nombre');
            $table->boolean('activo')->default(true);
            $table->unsignedSmallInteger('orden')->default(0);
            $table->timestamps();

            $table->index(['categoria', 'activo', 'orden']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('servicio_seccion_items');
    }
};
