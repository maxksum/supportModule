<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKarmaVotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('karma_votes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("user_id");
            $table->integer("target_id");
            $table->integer("mix_id");
            $table->integer("value");
            $table->string("comment")->nullable();
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
        Schema::dropIfExists('karma_votes');
    }
}
