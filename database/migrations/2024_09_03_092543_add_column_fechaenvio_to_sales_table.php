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
        Schema::table('sales', function (Blueprint $table) {
            //
            $table->timestamp('fechaenvio')->nullable()->after('created_at');
            $table->string('doc_number')->nullable();

            $table->dropColumn('status_code');
            $table->unsignedBigInteger('status_id')->nullable();
            $table->foreign('status_id')->references('id')->on('statuses');

            $table->boolean('confirmation_user')->default(false);
            $table->boolean('confirmation_client')->default(false);

            $table->string('tipo_comprobante')->default('Nota de venta');
            $table->longText('status_message')->change();

            $table->string('razon_fact')->nullable();
            $table->string('direccion_fact')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sales', function (Blueprint $table) {
            //
            $table->dropColumn('fechaenvio');
            $table->dropColumn('doc_number');

            $table->dropForeign(['status_id']);
            $table->dropColumn('status_id');
            $table->string('status_code');

            $table->dropColumn('confirmation_user');
            $table->dropColumn('confirmation_client');
            
            $table->dropColumn('tipo_comprobante');
            $table->text('status_message')->change();

            $table->dropColumn('razon_fact');
            $table->dropColumn('direccion_fact');


        });
    }
};
