<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->comment('文章标题')->nullable();
            $table->integer('c_id')->comment('所属分类')->nullable();
            $table->string('image')->comment('文章配图');
            $table->text('content')->comment('文章内容');
            $table->integer('is_hidden')->comment('是否上架 0，下架|1，上架')->nullable();
            $table->text('desc')->comment('文章简介');
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
        Schema::dropIfExists('article');
    }
}
