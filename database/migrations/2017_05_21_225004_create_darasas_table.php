<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDarasasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('darasas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('childs_age');
            $table->integer('teacher_id')->unsigned();
            $table->integer('topic_id')->unsigned();
            $table->integer('parent_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('teacher_id')->references('id')->on('teachers');
            $table->foreign('topic_id')->references('id')->on('topics');
            $table->foreign('parent_id')->references('id')->on('parents');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('darasas');
    }
}
