<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTopicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('topics', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('body');
            $table->integer('teacher_id')->unsigned();
            $table->integer('food_id')->unsigned();
            $table->integer('topic_category_id')->unsigned();
            $table->integer('image_id')->unsigned()->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('teacher_id')->references('id')->on('teachers');
            $table->foreign('food_id')->references('id')->on('foods');
            $table->foreign('image_id')->references('id')->on('images');
            $table->foreign('topic_category_id')->references('id')->on('topic_categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('topics');
    }
}
