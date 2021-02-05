<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditMixesTableBestPlayer extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mixes', function (Blueprint $table) {
            //
            $table->integer("best_player")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mixes', function (Blueprint $table) {
            //
            $table->dropColumn("best_player");
        });
    }
}
