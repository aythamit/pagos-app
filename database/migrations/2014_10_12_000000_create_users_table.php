<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('apellidos');
            $table->string('dni');
            $table->string('telefono');
            $table->string('tipo')->default('empleado');
            $table->string('cargo_empresa')->nullable();
            $table->string('descripcion')->nullable();
            $table->string('color')->nullable();
            $table->string('rol')->nullable();
            $table->longText('imagen')->nullable();
            $table->string('email')->unique();
            $table->string('email_verify_token')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->tinyInteger('is_blocked')->default(0);

            $table->unsignedBigInteger('tienda_id')->nullable();

            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
