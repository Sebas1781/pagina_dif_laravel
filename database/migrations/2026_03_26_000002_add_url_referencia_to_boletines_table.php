<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('boletines', function (Blueprint $table) {
            $table->string('url_referencia')->nullable()->after('imagen');
        });
    }

    public function down(): void
    {
        Schema::table('boletines', function (Blueprint $table) {
            $table->dropColumn('url_referencia');
        });
    }
};
