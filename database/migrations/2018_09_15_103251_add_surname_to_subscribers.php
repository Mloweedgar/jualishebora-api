<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSurnameToSubscribers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('subscribers', function (Blueprint $table) {
            $table->dropForeign('subscribers_teacher_id_foreign');
            $table->dropColumn('teacher_id');
            $table->string('surname');
            $table->boolean('status')->default(true);


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('subscribers', function (Blueprint $table) {
            $table->dropColumn('surname');
            $table->dropColumn('status');
            $table->integer('teacher_id')->unsigned();
            $table->foreign('teacher_id')->references('id')->on('teachers');


        });
    }
}
