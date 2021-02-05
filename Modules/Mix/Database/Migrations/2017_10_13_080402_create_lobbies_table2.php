<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLobbiesTable2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lobbies', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("creator_id");
            $table->integer("per_team");
            $table->integer("map_id");
            $table->string("password")->nullable();
            $table->integer("eac");
            $table->integer("hidden");
            $table->integer("auto_balance");
            $table->integer("bet");
            $table->integer("state")->default(0);
            $table->integer("mix_id")->nullable();
            $table->timestamp("vote_ends")->nullable();
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
        Schema::drop('lobbies');
    }
}
