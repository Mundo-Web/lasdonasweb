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
        Schema::table('generals', function (Blueprint $table) {
            $table->string('ig_token')->nullable();
            $table->string('url_video')->nullable();
            $table->string('titulo_video')->nullable();
            $table->string('sub_titulo_video')->nullable();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('generals', function (Blueprint $table) {
            //
            $table->dropColumn('ig_token');
            $table->dropColumn('url_video');
            $table->dropColumn('titulo_video');
            $table->dropColumn('sub_titulo_video');
        });
    }
};
