<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMixesTable2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mixes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('map_id');
            $table->integer('player_bet');
            $table->integer('per_team');
            $table->integer('game_status');
            $table->integer('server_id');
            $table->string("winner_team")->nullable();
            $table->string("score")->nullable()->default("0:0");
            $table->integer("eac")->default(0);
            $table->integer("lobby_id")->default(0);
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
        Schema::drop('mixes');
    }
}
