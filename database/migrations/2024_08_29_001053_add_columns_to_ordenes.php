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
            $table->integer('points')->default(0);
            $table->string('numero_tarjeta')->nullable();
            $table->longText('culqi_data')->nullable();
            $table->longText('address_full')->nullable();
            $table->string('address_owner')->nullable();
            $table->string('address_zipcode');
            $table->decimal('address_latitude', 16, 10);
            $table->decimal('address_longitude', 16, 10);
            $table->longText('address_data')->nullable();
            $table->string('billing_type')->nullable();
            $table->string('billing_document')->nullable();
            $table->string('billing_name')->nullable();
            $table->longText('billing_address')->nullable();
            $table->string('billing_email')->nullable();
            $table->string('consumer_phone')->nullable();
            $table->string('dedication_id')->nullable();
            $table->string('dedication_title')->nullable();
            $table->longText('dedication_message')->nullable();
            $table->string('dedication_sign')->nullable();
            $table->string('dedication_image')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ordenes', function (Blueprint $table) {
            $table->dropColumn([
                'points',
                'numero_tarjeta',
                'culqi_data',
                'address_full',
                'address_owner',
                'address_zipcode',
                'address_latitude',
                'address_longitude',
                'address_data',
                'billing_type',
                'billing_document',
                'billing_name',
                'billing_address',
                'billing_email',
                'consumer_phone',
                'dedication_id',
                'dedication_title',
                'dedication_message',
                'dedication_sign',
                'dedication_image',
            ]);
        });
    }
};
