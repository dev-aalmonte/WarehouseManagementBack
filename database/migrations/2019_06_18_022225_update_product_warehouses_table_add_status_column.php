<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateProductWarehousesTableAddStatusColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_warehouses', function (Blueprint $table) {
            $table->unsignedBigInteger('statusID');

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
        Schema::table('product_warehouses', function (Blueprint $table) {
            $table->dropdForeign(['statusID']);
            $table->dropColumn(['statusID']);
        });
    }
}
