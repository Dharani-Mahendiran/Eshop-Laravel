<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
            Schema::table('users', function (Blueprint $table) {
                $table->string('lname')->after('name');
                $table->string('phone')->after('password');
                $table->string('alt_contact')->after('phone');
                $table->string('city')->after('alt_contact');
                $table->string('state')->after('city');
                $table->string('country')->after('state');
                $table->integer('pincode')->after('country');
            }); 
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('lname');
            $table->dropColumn('phone');
            $table->dropColumn('alt_contact');
            $table->dropColumn('city');
            $table->dropColumn('state');
            $table->dropColumn('country');
            $table->dropColumn('pincode');
        });
    }
}
