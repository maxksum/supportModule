<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditTicketRatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('ticket_ratings', function (Blueprint $table) {
          //
          $table->integer("option");
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('ticket_ratings', function (Blueprint $table) {
        //
        $table->dropColumn('option');
      });
    }
}
