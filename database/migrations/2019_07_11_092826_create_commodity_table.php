<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommodityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commodity', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment('商品名称')->nullable();
            $table->integer('m_id')->comment('所属商户')->nullable();
            $table->string('desc')->comment('商品简介')->nullable();
            $table->integer('price')->comment('商品价格')->nullable();
            $table->integer('integral')->comment('换购积分')->nullable();
            $table->string('image')->comment('商品图片');
            $table->integer('is_up')->comment('是否上架')->nullable();
            $table->integer('order')->comment('排序')->nullable();
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
        Schema::dropIfExists('commodity');
    }
}
