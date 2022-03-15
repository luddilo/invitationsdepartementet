<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->delete();
        $arr = ['Administrator', 'Ambassador', 'Member'];

        foreach ($arr as $data) {
            App\Models\Role::create([
                'name' => $data
            ]);
        }
    }
}
