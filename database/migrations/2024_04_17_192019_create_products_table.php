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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('producto');
            $table->string('extract')->nullable();
            $table->text('description')->nullable();
            $table->decimal('precio', 12, 2)->default(0)->nullable();
            $table->decimal('descuento', 12, 2)->default(0)->nullable();
            $table->decimal('preciofiltro', 12, 2)->default(0)->nullable();
            $table->decimal('stock', 12, 2)->default(0)->nullable();
            $table->decimal('costo_x_art', 12, 2)->default(0)->nullable();
            $table->decimal('peso', 12, 2)->default(0)->nullable();
            $table->string('sku')->nullable();
            $table->string('imagen')->nullable();
            $table->json('atributes')->nullable();
            $table->boolean('liquidacion')->default(false);
            $table->boolean('destacar')->default(false);
            $table->boolean('recomendar')->default(false);
            $table->unsignedBigInteger('categoria_id')->nullable();
            $table->unsignedBigInteger('collection_id')->nullable();

            $table->boolean('visible')->default(true);
            $table->boolean('status')->default(true);
            $table->timestamps();

            $table->foreign('categoria_id')->references('id')->on('categories');
            $table->foreign('collection_id')->references('id')->on('collections');
            
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
