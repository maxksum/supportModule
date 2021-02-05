<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSkillRangeToLobbies extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lobbies', function (Blueprint $table) {
            //
            $table->integer("skill_from")->default(1);
            $table->integer("skill_to")->default(7);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lobbies', function (Blueprint $table) {
            //
            $table->dropColumn("skill_from");
            $table->dropColumn("skill_to");
        });
    }
}
