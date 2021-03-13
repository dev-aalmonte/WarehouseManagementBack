<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderDetailsForeignKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // $table->unsignedBigInteger('orderID')->change();
        // $table->unsignedBigInteger('productID')->change();

        Schema::table('orderDetails', function (Blueprint $table) {
            $table->foreign('orderID')->references('id')->on('orders');
            $table->foreign('productID')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orderDetails', function (Blueprint $table) {
            $table->dropForeign(['orderID']);
            $table->dropForeign(['productID']);
        });
    }
}
