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
        Schema::create('historico_cupones', function (Blueprint $table) {
            $table->id();
           /*  cupones_id
            user_id
            fecha_canje
            orden_id */
            $table->unsignedBigInteger('cupones_id');
            $table->unsignedBigInteger('user_id');
            $table->date('fecha_canje')->nullable();
            $table->boolean('usado')->default(false);
            $table->string('orden_id')->nullable();
            $table->timestamps();

            $table->foreign('cupones_id')->references('id')->on('cupons');  
            $table->foreign('user_id')->references('id')->on('users');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historico_cupones');
    }
};
