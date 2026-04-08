<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('remtys_cards', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('icono')->default('fa-file-lines');
            $table->string('color_gradiente')->default('from-purple-700/80 to-purple-500/80');
            $table->boolean('activo')->default(true);
            $table->unsignedSmallInteger('orden')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('remtys_cards');
    }
};
