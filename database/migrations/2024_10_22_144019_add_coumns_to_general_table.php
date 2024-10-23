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
            //
            //primer_text, second_text, url_cintillo

            $table->string('primer_text')->nullable();
            $table->string('second_text')->nullable();
            $table->string('url_cintillo')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('generals', function (Blueprint $table) {
            //
            $table->dropColumn('primer_text');
            $table->dropColumn('second_text');
            $table->dropColumn('url_cintillo');
        });
    }
};
