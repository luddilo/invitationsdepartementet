<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MakingPartnerARealObject extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partners', function (Blueprint $table) {
            $table->increments('id');
            $table->char('gender');
            $table->string('type');
            $table->integer('partnerable_id');
            $table->string('partnerable_type');
            $table->timestamps();
        });

        Schema::table('users', function (Blueprint $table) {
           $table->dropColumn('partners');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('partners');

        Schema::table('users', function (Blueprint $table) {
            $table->string('partners');
        });
    }
}
