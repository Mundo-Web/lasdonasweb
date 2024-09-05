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
        Schema::table('ordenes', function (Blueprint $table) {
            // Verificar si la clave foránea existe antes de eliminarla
            $foreignKeys = Schema::getConnection()->getDoctrineSchemaManager()->listTableForeignKeys('ordenes');
            foreach ($foreignKeys as $foreignKey) {
                if ($foreignKey->getName() === 'ordenes_status_id_foreign') {
                    $table->dropForeign(['status_id']);
                }
            }

            // Agregar la nueva clave foránea
            $table->foreign('status_id')->references('id')->on('statuses');
        });
    }

    public function down()
    {
        Schema::table('ordenes', function (Blueprint $table) {
            $table->dropForeign(['status_id']);
        });
    }
};
