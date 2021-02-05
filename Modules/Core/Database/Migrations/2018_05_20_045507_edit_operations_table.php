<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditOperationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('operations', function (Blueprint $table) {
            //
            $table->integer('product_id')->nullable();
            $table->integer('product_code');
            $table->dropColumn('mix_id');
            $table->dropColumn('csdm_id');
            $table->renameColumn('operation', 'operation_code');
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
            //
            $table->integer("mix_id")->nullable();
            $table->integer("csdm_id")->nullable();
            $table->dropColumn('product_id');
            $table->dropColumn('product_code');
            $table->renameColumn('operation_code', 'operation');
        });
    }
}
