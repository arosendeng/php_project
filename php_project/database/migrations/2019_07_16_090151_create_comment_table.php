<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comment', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->comment('用户ID')->nullable();
            $table->integer('parent_id')->comment('商户ID')->nullable();
            $table->integer('evaluation_all')->default('4')->comment('总体评价')->nullable();
            $table->integer('evaluation_taste')->default('4')->comment('口味评价')->nullable();
            $table->integer('evaluation_milieu')->default('4')->comment('环境评价')->nullable();
            $table->integer('evaluation_service')->default('4')->comment('服务评价')->nullable();
            $table->integer('evaluation_safe')->default('4')->comment('安全评价')->nullable();
            $table->string('content')->comment('评价内容')->nullable();
            $table->string('image')->comment('评论图片');
            $table->string('per_capita');
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
        Schema::dropIfExists('comment');
    }
}
