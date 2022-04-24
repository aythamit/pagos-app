<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePedidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->string('doc');
            $table->longText('info_pago');
            $table->longText('pedido');
            $table->longText('observaciones');
            $table->dateTime('fecha_entrega');
            $table->string('estado');
            $table->timestamps();

            $table->foreignId('user_id')->nullable()->references('id')->on('users')->onUpdate('CASCADE')->onDelete('SET NULL');
            $table->foreignId('tienda_id')->nullable()->references('id')->on('tiendas')->onUpdate('CASCADE')->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pedidos');
    }
}
