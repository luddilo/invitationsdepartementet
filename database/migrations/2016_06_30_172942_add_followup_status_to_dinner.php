<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFollowupStatusToDinner extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dinners', function (Blueprint $table) {
            $table->renameColumn('feedback_status_host', 'feedback_status');
            $table->dropColumn('feedback_status_guest');
            $table->integer('followup_status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('dinners', function (Blueprint $table) {
            $table->renameColumn('feedback_status', 'feedback_status_host');
            $table->integer('feedback_status_guest');
            $table->dropColumn('followup_status');
        });
    }
}
