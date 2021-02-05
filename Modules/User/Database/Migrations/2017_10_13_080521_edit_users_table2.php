<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditUsersTable2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->string('nick')->nullable();
            $table->integer('money')->default(0);
            $table->integer("role")->default(1);
            $table->string('steamid')->unique()->nullable();
            $table->string('steamid64')->unique()->nullable();
            $table->string('profile')->nullable();
            $table->string('avatar')->nullable();
            $table->string('avatar_medium')->nullable();
            $table->string('avatar_full')->nullable();
            $table->string('trade_link')->nullable();
            $table->dropColumn('email');
            $table->integer("state")->after('password')->default(0);
            $table->integer("vk_id")->nullable()->default(0);
            $table->string("referral_code")->nullable();
            $table->string("referrer_id")->nullable();
            $table->float("referral_profit")->default(0);
            $table->integer("current_game_id")->nullable();
            $table->string("youtube_channel")->nullable();
            $table->string("twitch_channel")->nullable();
            $table->timestamp("banned_until")->nullable();
            $table->string("ban_reason")->nullable();
            $table->integer("chat_ban")->default(0);
            $table->string("chatban_until")->nullable();
            $table->string("chatban_reason")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->dropColumn('nick');
            $table->dropColumn('money');
            $table->dropColumn('role');
            $table->dropColumn('steamid');
            $table->dropColumn('steamid64');
            $table->dropColumn('profile');
            $table->dropColumn('avatar');
            $table->dropColumn('avatar_medium');
            $table->dropColumn('avatar_full');
            $table->dropColumn('trade_link');
            $table->string('email')->unique();
            $table->dropColumn('state');
            $table->dropColumn('vk_id');
            $table->dropColumn('referral_code');
            $table->dropColumn('referrer_id');
            $table->dropColumn('referral_profit');
            $table->dropColumn('current_game_id');
            $table->dropColumn('youtube_channel');
            $table->dropColumn('twitch_channel');
            $table->dropColumn('banned_until');
            $table->dropColumn('ban_reason');
            $table->dropColumn('chat_ban');
            $table->dropColumn('chatban_until');
            $table->dropColumn('chatban_reason');
        });
    }
}
