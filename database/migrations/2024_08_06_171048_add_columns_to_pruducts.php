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
        Schema::table('products', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('complemento_id')->nullable();
            $table->string('puntos_complemento')->nullable();

            $table->foreign('complemento_id')->references('id')->on('complementos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            //
            $table->dropForeign(['complemento_id']);
            $table->dropColumn('complemento_id');
            $table->dropColumn('puntos_complemento');

        });
    }
};
