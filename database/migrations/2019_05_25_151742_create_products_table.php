<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->decimal('price', 8, 2);
            $table->text('description');
            $table->string('metric_weight', 10)->nullable()->default('lbs');
            $table->decimal('weight', 6, 2)->nullable();
            $table->string('metric_longitude', 10)->nullable()->default('ft');
            $table->decimal('width', 6, 2)->nullable();
            $table->decimal('height', 6, 2)->nullable();
            $table->decimal('length', 6, 2)->nullable();
            $table->unsignedInteger('warehouseID');
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
        Schema::dropIfExists('products');
    }
}
