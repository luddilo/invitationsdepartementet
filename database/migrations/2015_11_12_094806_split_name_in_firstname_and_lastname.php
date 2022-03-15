<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Models\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Log;

class SplitNameInFirstnameAndLastname extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('last_name')->after('id');
            $table->string('first_name')->after('id');
        });

        $users = User::all();

        foreach($users as $user) {
            $name = $user->name;
            $names = explode(' ', $name);
            $user->first_name = $names[0];
            if(array_key_exists(1, $names)){
                $user->last_name = $names[1];
            }
            $user->save();
        }

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('name');
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
            $table->string('name')->after('id');
        });

        $users = User::all();

        foreach($users as $user) {
            $user->name = $user->first_name . ' ' . $user->last_name;
            $user->save();
        }

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('first_name');
            $table->dropColumn('last_name');
        });
    }
}
