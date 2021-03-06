<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orderUsers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('orderID');
            $table->unsignedBigInteger('userID');
            $table->unsignedBigInteger('statusID');
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
        Schema::dropIfExists('orderUsers');
    }
}
