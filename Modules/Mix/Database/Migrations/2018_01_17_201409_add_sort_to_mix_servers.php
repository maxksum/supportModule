<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSortToMixServers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mix_server_locations', function (Blueprint $table) {
            //
            $table->integer("sort")->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mix_server_locations', function (Blueprint $table) {
          $table->dropColumn("sort");
            //
        });
    }
}
