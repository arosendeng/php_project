<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user', function (Blueprint $table) {
            $table->increments('user_id');
            $table->string('user_name')->comment('用户名')->nullable();
            $table->string('password')->comment('密码')->nullable();
            $table->string('mobile')->comment('电话号码')->nullable();
            $table->integer('integral')->comment('积分')->nullable();
            $table->integer('type')->comment('用户类别')->nullable();
            $table->integer('sex')->comment('性别');
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
        Schema::dropIfExists('user');
    }
}
