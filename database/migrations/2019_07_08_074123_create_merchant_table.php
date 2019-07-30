<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMerchantTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('merchant', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment('商户名称')->nullable();
            $table->integer('cat')->comment('商户类别')->nullable();
            $table->integer('order')->comment('排序')->nullable();
            $table->string('desc')->comment('商户描述');
            $table->string('phone')->comment('电话号码');
            $table->string('address')->comment('商户地址');
            $table->integer('is_hidden')->comment('是否显示')->nullable();
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
        Schema::dropIfExists('merchant');
    }
}
