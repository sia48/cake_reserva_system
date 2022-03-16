<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('shop_id');
            $table->string('shop_name');
            $table->string('through');
            $table->string('cake_maker');
            $table->string('cake_number');
            $table->string('cake_name');
            $table->tinyInteger('quantity');
            $table->integer('customer_id');
            $table->string('reserva_date');
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
        Schema::dropIfExists('orders');
    }
}
