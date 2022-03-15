<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDinnerPreferencePivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('preference_dinner', function(Blueprint $table) {
            $table->integer('dinner_id')->unsigned()->index();
            $table->foreign('dinner_id')->references('id')->on('dinners')->onDelete('cascade');
            $table->integer('preference_id')->unsigned()->index();
            $table->foreign('preference_id')->references('id')->on('preferences')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('preference_dinner');
    }
}
