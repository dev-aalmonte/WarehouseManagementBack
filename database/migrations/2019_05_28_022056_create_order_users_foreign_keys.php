<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderUsersForeignKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::table('orderusers', function (Blueprint $table) {
        //     $table->unsignedBigInteger('orderID')->change();
        //     $table->unsignedBigInteger('userID')->change();
        //     $table->unsignedBigInteger('statusID')->change();
        // });

        Schema::table('orderUsers', function (Blueprint $table){
            $table->foreign('orderID')->references('id')->on('orders');
            $table->foreign('userID')->references('id')->on('users');
            $table->foreign('statusID')->references('id')->on('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orderusers', function (Blueprint $table) {
            $table->dropForeign(['orderID']);
            $table->dropForeign(['userID']);
            $table->dropForeign(['statusID']);
        });
    }
}
