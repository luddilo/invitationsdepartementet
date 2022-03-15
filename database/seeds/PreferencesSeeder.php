<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Models\Preference;

class PreferencesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('preferences')->delete();
        $arr = ['Gluten', 'Pet Hair'];

        foreach ($arr as $data) {
            Preference::create([
                'name_guesting' => $data,
                'name_hosting' => $data

            ]);
        }
    }
}
