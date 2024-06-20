<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsFechasToNomina extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('nomina', function (Blueprint $table) {
            $table->float('isr',5,2)->nullable();
            $table->date('fecha_inicio')->nullable();
            $table->date('fecha_fin')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('nomina', function (Blueprint $table) {
            $table->dropColumn('isr');
            $table->dropColumn('fecha_inicio');
            $table->dropColumn('fecha_fin');
        });
    }
}
