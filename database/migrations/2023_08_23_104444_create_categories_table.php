<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->longText('description');
            $table->string('image')->nullable;
            $table->string('meta_title');
            $table->mediumText('meta_description');
            $table->string('meta_keyword');
            $table->tinyInteger('status')->default('0')->comment('0=visible,1=hidden');
            $table->tinyInteger('popular')->default('0')->comment('0=pop-hide,1=pop-show');
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
        Schema::dropIfExists('categories');
    }
}
