<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('politica_sustitucions', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('content')->nullable();
            $table->string('finaltitle')->nullable();
            $table->timestamps();
        });

        // Insert seed data
        DB::table('politica_sustitucions')->insert([
        'title' => 'Título de Ejemplo',
        'content' => 'Contenido de Ejemplo',
        'finaltitle' => 'Título Final de Ejemplo',
        'created_at' => now(),
        'updated_at' => now(),
    ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('politica_sustitucions');
    }
};
