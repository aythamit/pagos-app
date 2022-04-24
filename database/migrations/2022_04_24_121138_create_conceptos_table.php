<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConceptosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conceptos', function (Blueprint $table) {
            $table->id();
            $table->longText('concepto')->nullable();
            $table->double('euro')->default(0.0);
            $table->boolean('is_pagado')->default(0);
            $table->date('fecha_pago')->nullable();

            $table->unsignedBigInteger('users_id')->nullable();
            $table->unsignedBigInteger('conceptos_tipos_id')->nullable();
            $table->foreign('users_id')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('conceptos_tipos_id')->references('id')->on('conceptos_tipos')->onUpdate('CASCADE')->onDelete('CASCADE');

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
        Schema::dropIfExists('conceptos');
    }
}
