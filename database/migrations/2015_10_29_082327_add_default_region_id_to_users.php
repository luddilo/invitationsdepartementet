<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDefaultRegionIdToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0'); // disable foreign key constraints

        Schema::table('users', function (Blueprint $table) {

//            $table->dropForeign('users_region_id_foreign');
  //          $table->integer('region_id')->default(1)->change();

        });
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0'); // disable foreign key constraints
        Schema::table('users', function (Blueprint $table) {
            $table->integer('region_id')->unsigned()->change();
            $table->foreign('region_id')->references('id')->on('regions');
        });
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
