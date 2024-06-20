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
        Schema::create('sliders', function (Blueprint $table) {
            $table->id();
            $table->string('subtitle')->nullable();
            $table->string('title2')->nullable();
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->string('botontext1')->nullable();
            $table->string('link1')->nullable();
            $table->string('botontext2')->nullable();
            $table->string('link2')->nullable();
            $table->string('url_image')->nullable();
            $table->string('name_image')->nullable();
            $table->string('url_image2')->nullable();
            $table->string('name_image2')->nullable();
            $table->boolean('visible')->default(false);
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sliders');
    }
};
