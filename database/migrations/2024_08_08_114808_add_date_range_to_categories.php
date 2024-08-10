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
        Schema::table('categories', function (Blueprint $table) {
            $table->date('start_date_campaing')->nullable();
            $table->date('end_date_campaing')->nullable();
            $table->boolean('is_active_campaing')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            //
            $table->dropColumn('start_date_campaing');
            $table->dropColumn('end_date_campaing');
            $table->dropColumn('is_active_campaing');
            
        });
    }
};
