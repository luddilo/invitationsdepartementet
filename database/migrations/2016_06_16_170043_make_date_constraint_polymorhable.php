<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MakeDateConstraintPolymorhable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('date_constraints', function (Blueprint $table) {
            $table->renameColumn('region_id', 'constrainable_id');
            $table->string('constrainable_type')->after('id');
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
            $table->renameColumn('constrainable_id', 'region_id');
            $table->dropColumn('constrainable_type');
        });
    }
}
