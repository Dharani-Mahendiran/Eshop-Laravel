<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDatesToOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_items', function (Blueprint $table) {
            $table->date('dispatched_date')->nullable()->after('tracking_number');
            $table->date('intransit_date')->nullable()->after('dispatched_date');
            $table->date('delivered_date')->nullable()->after('intransit_date');
            $table->date('exch_ret_date')->nullable()->after('delivered_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_items', function (Blueprint $table) {
            $table->dropColumn('dispatched_date');
            $table->dropColumn('intransit_date');
            $table->dropColumn('delivered_date');
            $table->dropColumn('exch_ret_date');
        });
    }
}
