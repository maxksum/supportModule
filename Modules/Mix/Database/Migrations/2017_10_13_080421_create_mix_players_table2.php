<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMixPlayersTable2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mix_players', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('mix_id');
            $table->boolean('team');
            $table->integer("entered")->default(0);
            $table->integer("leaved")->default(0);
            $table->integer("banned")->default(0);
            $table->integer("winner")->nullable();
            $table->integer("exp_ratio")->default(0);
            $table->integer("kills")->default(0);
            $table->integer("deaths")->default(0);
            $table->integer("headshot_kills")->default(0);
            $table->integer("assists")->default(0);
            $table->integer("flashbang_assists")->default(0);
            $table->integer("teamkills")->default(0);
            $table->integer("suicides")->default(0);
            $table->integer("damage")->default(0);
            $table->integer("roundsplayed")->default(0);
            $table->integer("bomb_defuses")->default(0);
            $table->integer("bomb_plants")->default(0);
            $table->integer("1kill_rounds")->default(0);
            $table->integer("2kill_rounds")->default(0);
            $table->integer("3kill_rounds")->default(0);
            $table->integer("4kill_rounds")->default(0);
            $table->integer("5kill_rounds")->default(0);
            $table->integer("v1")->default(0);
            $table->integer("v2")->default(0);
            $table->integer("v3")->default(0);
            $table->integer("v4")->default(0);
            $table->integer("v5")->default(0);
            $table->integer("firstkill_t")->default(0);
            $table->integer("firstkill_ct")->default(0);
            $table->integer("firstdeath_t")->default(0);
            $table->integer("firstdeath_ct")->default(0);
            $table->integer("tradekill")->default(0);
            $table->string("name_on_server")->nullable();
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
        Schema::drop('mix_players');
    }
}
