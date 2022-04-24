<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersHasPermisosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_has_permisos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('users_id')->nullable();
            //$table->unsignedBigInteger('admins_id')->nullable();
            $table->unsignedBigInteger('permisos_id')->nullable();
            $table->boolean('leer')->default(1);
            $table->boolean('editar')->default(1);
            $table->boolean('borrar')->default(1);
            $table->timestamps();

            $table->foreign('users_id')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
            //$table->foreign('admins_id')->references('id')->on('admins')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('permisos_id')->references('id')->on('permisos')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_has_permisos');
    }
}
