<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditMixesTable extends Migration
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
            $table->integer("auto_balance");
            $table->integer("hidden");
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
            $table->dropColumn("auto_balance");
            $table->dropColumn("hidden");
        });
    }
}
