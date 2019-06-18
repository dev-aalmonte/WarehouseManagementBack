<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsWarehousesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_warehouses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('productID');
            $table->unsignedBigInteger('warehouseID');
            $table->unsignedInteger('stock');
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
        Schema::dropIfExists('product_warehouses');
    }
}
