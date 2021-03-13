<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateOrderDetailsTableAddPackedAndPackedByColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orderDetails', function (Blueprint $table) {
            $table->boolean("packed")->after('picked_by')->default(false);
            $table->unsignedBigInteger("packed_by")->after('packed')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orderDetails', function (Blueprint $table) {
            $table->dropColumn('packed');
            $table->dropColumn('packed_by');
        });
    }
}
