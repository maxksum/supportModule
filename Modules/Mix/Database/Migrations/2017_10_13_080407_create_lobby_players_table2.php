<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLobbyPlayersTable2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lobby_players', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("user_id");
            $table->integer("lobby_id");
            $table->integer("team");
            $table->integer("ready")->default(0);
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
        Schema::drop('lobby_players');
    }
}
