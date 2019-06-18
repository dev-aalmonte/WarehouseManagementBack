<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateProductsTableRemoveWarehouseAndStatusColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['warehouseID']);
            $table->dropForeign(['statusID']);

            $table->dropColumn(['warehouseID']);
            $table->dropColumn(['statusID']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->unsignedBigInteger('warehouseID')->nullable();
            $table->unsignedBigInteger('statusID')->nullable();

            $table->foreign('warehouseID')->references('id')->on('warehouses');
            $table->foreign('statusID')->references('id')->on('status');
        });
    }
}
