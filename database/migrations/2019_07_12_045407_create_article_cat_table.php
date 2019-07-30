<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticleCatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article_cat', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment('分类名称')->nullable();
            $table->string('desc')->comment('分类描述');
            $table->string('order')->default('10')->comment('排序')->nullable();
            $table->string('is_hidden')->comment('是否隐藏')->nullable();
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
        Schema::dropIfExists('article_cat');
    }
}
