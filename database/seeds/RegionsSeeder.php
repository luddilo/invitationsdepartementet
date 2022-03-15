<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Models\Region;


class RegionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0'); // disable foreign key constraints
        DB::table('regions')->delete();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1'); // disable foreign key constraints

        $arr = ['Stockholm', 'Göteborg', 'Malmö', 'Norrköping', 'Umeå'];

        foreach ($arr as $data) {
            Region::create([
                'name' => $data
            ]);
        }
    }
}
