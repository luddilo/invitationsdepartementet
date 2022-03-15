<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ReAddNotesFieldFromUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dinners', function (Blueprint $table) {
            $table->renameColumn('notes', 'other_info');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->text('other_info');
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
            $table->renameColumn('other_info', 'notes');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('other_info');
        });
    }
}
