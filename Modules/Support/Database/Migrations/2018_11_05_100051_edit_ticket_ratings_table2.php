<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditTicketRatingsTable2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('ticket_ratings', function (Blueprint $table) {
          $table->integer("admin_id");
          $table->integer('rating_quality');
          $table->dropColumn('option');
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
          $table->dropColumn("admin_id");
          $table->dropColumn('rating_quality');
      });

    }
}
