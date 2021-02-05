<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMapsTable2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maps', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('file');
            $table->string('image');
            $table->string("type")->nullable();
            $table->string('short_name')->nullable();
            $table->integer("active")->default(1);
            $table->integer("sort")->default(0);
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
        Schema::drop('maps');
    }
}
