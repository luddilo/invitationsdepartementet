<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class LanguageAndRevampRoles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schools', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('level');
            $table->integer('region_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('schools', function (Blueprint $table) {
            $table->foreign('region_id')->references('id')->on('regions');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->boolean('fluent');
            $table->string('nationality');
            $table->integer('school_id');
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
            $table->dropColumn('fluent');
            $table->dropColumn('nationality');
            $table->dropColumn('school_id');
        });

        Schema::drop('schools');
    }
}
