<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameHiddenInLobbiesAndMixes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('lobbies', function (Blueprint $table) {
          $table->renameColumn("hidden", "players_hidden");
      });

      Schema::table('mixes', function (Blueprint $table) {
          $table->renameColumn("hidden", "players_hidden");
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
          $table->renameColumn("players_hidden", "hidden");
      });

      Schema::table('mixes', function (Blueprint $table) {
          $table->renameColumn("players_hidden", "hidden");
      });
    }
}
