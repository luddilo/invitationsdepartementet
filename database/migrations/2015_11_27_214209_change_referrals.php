<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeReferrals extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('referrals', function (Blueprint $table) {
            $table->dropColumn('user_id');
            $table->dropColumn('referrer_id');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->integer('referral_id');
            $table->integer('referrer_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('referrals', function (Blueprint $table) {
            $table->integer('user_id');
            $table->integer('referrer_id');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('referral_id');
            $table->dropColumn('referrer_id');
        });
    }
}
