<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMerchantCatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('merchant_cat', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cat_name')->comment('分类名称')->nullable();
            $table->string('desc')->comment('分类描述')->nullable();
            $table->integer('order')->default('10')->comment('排序')->nullable();
            $table->integer('parent_id')->comment('父级ID')->nullable();
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
        Schema::dropIfExists('merchant_cat');
    }
}
