<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateProductWarehousesAddOnCascadeDelete extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_warehouses', function (Blueprint $table) {
            $table->dropForeign(['productID']);
            $table->dropForeign(['warehouseID']);

            $table->foreign('productID')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('warehouseID')->references('id')->on('warehouses')->onDelete('cascade');
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
            $table->dropForeign(['productID']);
            $table->dropForeign(['warehouseID']);

            $table->foreign('productID')->references('id')->on('products');
            $table->foreign('warehouseID')->references('id')->on('warehouses');
        });
    }
}
