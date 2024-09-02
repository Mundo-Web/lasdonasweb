<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('precio_envios', function (Blueprint $table) {
            
            $table->string('direcction')->nullable()->change();
           
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('precio_envios', function (Blueprint $table) {
            
            $table->string('direcction')->nullable(false)->change();
            
            
        });
    }
};
