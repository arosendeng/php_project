<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdreTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordre', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->comment('用户ID')->nullable();
            $table->integer('m_id')->comment('商户ID')->nullable();
            $table->integer('p_number')->comment('人数')->nullable();
            $table->string('time')->comment('预约时间')->nullable();
            $table->string('order_number')->comment('订单号')->nullable();
            $table->integer('type')->comment('订单状态')->nullable();
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
        Schema::dropIfExists('ordre');
    }
}
