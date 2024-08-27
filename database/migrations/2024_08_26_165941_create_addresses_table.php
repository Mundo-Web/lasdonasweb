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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->unsignedBigInteger('price_id');
            $table->string('street');
            $table->string('number');
            $table->string('description')->nullable();
            $table->boolean('visible')->default(true);
            $table->boolean('isDefault')->default(false);
            $table->timestamps();

            $table->foreign('price_id')->references('id')->on('prices');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
