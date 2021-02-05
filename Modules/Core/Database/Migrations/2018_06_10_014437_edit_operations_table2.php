<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditOperationsTable2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('operations', function (Blueprint $table) {
        $table->bigInteger('sum')->change();
        $table->bigInteger('new_balance')->change();
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('operations', function (Blueprint $table) {
        $table->integer('sum')->change();
        $table->integer('new_balance')->change();
      });
        //
    }
}
