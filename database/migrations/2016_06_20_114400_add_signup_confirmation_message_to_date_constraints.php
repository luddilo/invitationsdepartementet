<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSignupConfirmationMessageToDateConstraints extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('date_constraints', function (Blueprint $table) {
            $table->text('confirmation_signup_message')->after('message')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('date_constraints', function (Blueprint $table) {
            $table->dropColumn('confirmation_signup_message');
        });
    }
}
