<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryProductsForeignKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('categoryproducts', function (Blueprint $table) {
            $table->unsignedBigInteger('productID')->change();
            $table->unsignedBigInteger('categoryID')->change();

            $table->foreign('productID')->references('id')->on('products');
            $table->foreign('categoryID')->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('categoryproducts', function (Blueprint $table) {
            $table->dropForeign(['productID']);
            $table->dropForeign(['categoryID']);
        });
    }
}
