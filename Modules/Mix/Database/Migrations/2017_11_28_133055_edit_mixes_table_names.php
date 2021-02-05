<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditMixesTableNames extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::table('mixes', function (Blueprint $table) {
        //     //
        //     $table->renameColumn("team1", "team1name");
        //     $table->renameColumn("team2", "team2name");
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::table('mixes', function (Blueprint $table) {
        //     //
        //     $table->renameColumn("team1name", "team1");
        //     $table->renameColumn("team2name", "team2");
        // });
    }
}
