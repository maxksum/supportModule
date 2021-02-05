<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeLobbiesTable extends Migration
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
            $table->dropColumn("name");
            $table->string("team1name")->after("per_team");
            $table->string("team2name")->after("team1name");
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
            $table->dropColumn("team2name");
            $table->dropColumn("team1name");
            $table->string("name")->after("id");
        });
    }
}
