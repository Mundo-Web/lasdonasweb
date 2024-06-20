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
        Schema::create('attributes', function (Blueprint $table) {
            $table->id();
            $table->string('titulo')->unique();
            $table->string('slug')->nullable();
            $table->unsignedBigInteger('type_atributte_id')->nullable();
            $table->string('imagen')->nullable();
            $table->text('descripcion')->nullable();
            $table->string('valores')->nullable();
            $table->string('color')->nullable();
            $table->boolean('visible')->default(true);
            $table->boolean('status')->default(true);
            $table->timestamps();
            
            $table->foreign('type_atributte_id')->references('id')->on('type_atributtes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {   
        Schema::dropIfExists('attributes');
        Schema::table('attributes', function (Blueprint $table) {
            $table->dropForeign(['type_atributte_id']);
            $table->dropColumn('type_atributte_id');
        });
        
    }
};
