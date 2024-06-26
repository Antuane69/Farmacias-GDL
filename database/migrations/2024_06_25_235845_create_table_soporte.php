<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableSoporte extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('soporte', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->date('fecha_entrega')->nullable();
            $table->string('descripcion');
            $table->string('tipo');
            $table->string('urgencia');
            $table->string('evidencia',)->nullable();
            $table->string('estatus',)->default('Pendiente');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('soporte');
    }
}
