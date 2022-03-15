<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Models\Role;

class AddSuperadminRole extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('roles', function (Blueprint $table) {
            $table->boolean('visible')->after('name')->default(1);
        });

        Role::create([
            'name'    => 'SuperAdministrator',
            'visible' => 0,
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('roles', function (Blueprint $table) {
            $table->dropColumn('visible');
        });

        Role::where('name', 'SuperAdministrator')->delete();
    }
}
