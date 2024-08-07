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
            $table->string('tipo_prodct')->nullable();
            $table->string('parent_id')->nullable();
            $table->string('tipo_servicio')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            //
            $table->dropColumn('tipo_prodct');
            $table->dropColumn('parent_id');
            $table->dropColumn('tipo_servicio');
        });
    }
};
