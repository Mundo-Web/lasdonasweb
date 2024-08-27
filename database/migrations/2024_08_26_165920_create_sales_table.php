<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('name');
            $table->string('lastname');
            $table->string('email');
            $table->string('phone');
            $table->string('address_department')->nullable();
            $table->string('address_province')->nullable();
            $table->string('address_district')->nullable();
            $table->decimal('address_price');
            $table->string('address_street')->nullable();
            $table->string('address_number')->nullable();
            $table->string('address_description')->nullable();
            $table->decimal('total');
            $table->string('status_code');
            $table->string('status_message');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
