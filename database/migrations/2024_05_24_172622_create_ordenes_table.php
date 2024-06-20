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
        Schema::create('ordenes', function (Blueprint $table) {
            $table->id();
            $table->string('codigo_orden');
            $table->string('monto');
            $table->string('precio_envio');
            $table->string('tipo_tarjeta')->nullable();

            $table->unsignedBigInteger('status_id');
            $table->unsignedBigInteger('usuario_id')->nullable();
            $table->unsignedBigInteger('address_id')->nullable();

            $table->timestamps();

            $table->foreign('status_id')->references('id')->on('status_ordens');
            $table->foreign('usuario_id')->references('id')->on('users');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ordenes');
    }
};
