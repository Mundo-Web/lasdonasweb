<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('horarios', function (Blueprint $table) { 
            $table->id();
            $table->time('start_time'); // Columna para la hora de inicio
            $table->time('end_time'); // Columna para la hora de fin
            $table->string('day'); // Columna para el día de la semana
            $table->boolean('visible')->default(1); // Columna para el estado del horario
            $table->boolean('status')->default(1); // Columna para el estado del horario
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('horarios');
    }
};
