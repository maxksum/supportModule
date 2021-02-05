<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOperationsTable2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('operations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("sum")->nullable();
            $table->integer("new_balance")->nullable();
            $table->integer("user_id")->nullable();
            $table->integer("operation");
            $table->integer("mix_id")->nullable();
            $table->integer("csdm_id")->nullable();
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
        Schema::drop('operations');
    }
}
