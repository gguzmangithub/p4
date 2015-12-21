<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderTreatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('order_treat', function (Blueprint $table) {

        $table->increments('id');
        $table->timestamps();
        # `order_id` and `treat_id` will be foreign keys, so they have to be unsigned
        #  Note how the field names here correspond to the tables they will connect...
        # `order_id` will reference the `orders table` and `treat_id` will reference the `treats` table.
        $table->integer('order_id')->unsigned();
        $table->integer('treat_id')->unsigned();

        # Make foreign keys
        $table->foreign('order_id')->references('id')->on('orders');
        $table->foreign('treat_id')->references('id')->on('treats');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('order_treat');
    }
}
