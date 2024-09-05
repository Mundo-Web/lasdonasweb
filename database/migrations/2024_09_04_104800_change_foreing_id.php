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
        Schema::table('ordenes', function (Blueprint $table) {
            //
            // $table->dropForeign('ordenes_status_id_foreign');

            // Agregar la nueva clave foránea
            $table->foreign('status_id')->references('id')->on('statuses');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ordenes', function (Blueprint $table) {
            //
            $table->dropForeign(['status_id']);

            // Restaurar la clave foránea original
            $table->foreign('status_id')->references('id')->on('status_ordens');
        });
    }
};
