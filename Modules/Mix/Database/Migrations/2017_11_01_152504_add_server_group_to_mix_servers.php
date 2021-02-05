<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddServerGroupToMixServers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mix_servers', function (Blueprint $table) {
            $table->integer("server_group_id")->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mix_servers', function (Blueprint $table) {
            $table->dropColumn("server_group_id");
        });
    }
}
