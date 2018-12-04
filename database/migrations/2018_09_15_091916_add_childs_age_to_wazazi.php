<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddChildsAgeToWazazi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('parents', function (Blueprint $table) {
            $table->integer('childs_id')->nullable()->change();
            $table->renameColumn('middle_name', 'surname');
            $table->dropColumn('last_name');
            $table->integer('childs_age');
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
        Schema::table('parents', function (Blueprint $table) {
            $table->renameColumn('surname', 'middle_name');
            $table->dropColumn('childs_age');
            $table->integer('last_name');
            $table->dropColumn('status');
        });
    }
}
