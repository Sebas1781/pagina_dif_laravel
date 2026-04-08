<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('remtys_documentos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('remtys_card_id')->constrained('remtys_cards')->cascadeOnDelete();
            $table->string('titulo');
            $table->string('archivo')->nullable();
            $table->string('url')->nullable();
            $table->boolean('activo')->default(true);
            $table->unsignedSmallInteger('orden')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('remtys_documentos');
    }
};
