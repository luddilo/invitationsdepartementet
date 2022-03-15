<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RevertFeedbackAndFollowupStatusToDinnerOnly extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dinners', function (Blueprint $table) {
            $table->integer('feedback_status_guest')->default(0)->after('feedback_status');
            $table->renameColumn('feedback_status', 'feedback_status_host');

            $table->integer('followup_status_guest')->default(0)->after('followup_status');
            $table->renameColumn('followup_status', 'followup_status_host');

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
            $table->renameColumn('feedback_status_host', 'feedback_status');
            $table->dropColumn('feedback_status_guest');

            $table->renameColumn('followup_status_host', 'followup_status');
            $table->dropColumn('followup_status_guest');
        });
    }
}
