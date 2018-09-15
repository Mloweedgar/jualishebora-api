<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUrlsToPosts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //

        Schema::table('posts', function (Blueprint $table) {
            $table->string('video_url')->nullable();
            $table->string('audio_url')->nullable();
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

        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn('video_url');
            $table->dropColumn('audio_url');
        });
    }
}
