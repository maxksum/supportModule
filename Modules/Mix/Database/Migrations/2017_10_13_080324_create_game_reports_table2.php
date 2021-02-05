<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGameReportsTable2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('game_reports', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("user_id");
            $table->integer("report_id");
            $table->integer("mix_id");
            $table->text("text");
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
        Schema::drop('game_reports');
    }
}
