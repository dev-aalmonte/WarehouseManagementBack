<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsForeignKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->unsignedBigInteger('billing_addressID')->change();
            $table->unsignedBigInteger('shipping_addressID')->change();

            $table->foreign('billing_addressID')->references('id')->on('addresses');
            $table->foreign('shipping_addressID')->references('id')->on('addresses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->dropForeign(['billing_addressID']);
            $table->dropForeign(['shipping_addressID']);
        });
    }
}
