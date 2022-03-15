<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangesToDinner extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dinners', function (Blueprint $table) {
            $table->dropColumn('quantity_established');
            $table->dropColumn('quantity_new');
            $table->integer('guests');
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
            $table->integer('quantity_established');
            $table->integer('quantity_new');
            $table->dropColumn('guests');
        });
    }
}
