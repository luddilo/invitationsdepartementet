<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FeedbackFixes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('addresses', function (Blueprint $table) {
            $table->dropColumn('instructions');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->text('notes');
        });

        Schema::table('dinners', function (Blueprint $table) {
            $table->text('notes');
        });

        Schema::table('matches', function (Blueprint $table) {
            $table->text('notes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('addresses', function (Blueprint $table) {
            $table->string('instructions');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('notes');
        });

        Schema::table('dinners', function (Blueprint $table) {
            $table->dropColumn('notes');
        });

        Schema::table('matches', function (Blueprint $table) {
            $table->dropColumn('notes');
        });
    }
}
