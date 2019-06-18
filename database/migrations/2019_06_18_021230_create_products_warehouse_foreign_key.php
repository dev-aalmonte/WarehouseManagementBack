<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsWarehouseForeignKey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_warehouses', function (Blueprint $table) {
            $table->foreign('productID')->references('id')->on('products');
            $table->foreign('warehouseID')->references('id')->on('warehouses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $table->dropForeign(['productID']);
        $table->dropForeign(['warehouseID']);
    }
}
