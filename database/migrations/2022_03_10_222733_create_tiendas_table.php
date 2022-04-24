<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTiendasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tiendas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('nombre_legal');
            $table->string('cif');
            $table->string('telefono');
            $table->string('email');
            $table->longText('imagenes')->nullable();
            $table->longText('direccion');
            $table->longText('codigo_postal');
            $table->longText('ciudad');
            $table->longText('provincia');
            $table->longText('descripcion');
            $table->string('url');
            $table->tinyInteger('is_blocked')->default(0);
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
        Schema::dropIfExists('tiendas');
    }
}
