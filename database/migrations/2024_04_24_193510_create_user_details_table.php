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
        Schema::create('user_details', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->string('nombre')->nullable();
            $table->string('apellidos')->nullable();
            $table->string('phone')->nullable();
            $table->unsignedBigInteger('departamento_id')->nullable();
            $table->unsignedBigInteger('provincia_id')->nullable();
            $table->unsignedBigInteger('distrito_id')->nullable();
            $table->string('dir_av_calle')->nullable();
            $table->string('dir_numero')->nullable();
            $table->string('dir_bloq_lote')->nullable();
            $table->string('imagen')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->boolean('status')->default(true);


            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_details');
    }
};
