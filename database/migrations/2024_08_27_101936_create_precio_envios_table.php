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
        Schema::create('precio_envios', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('direcction');
            $table->string('zip_code');
            $table->decimal('price', 8, 2);           

            $table->boolean('visible')->default(true);
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('precio_envios');
    }
};
