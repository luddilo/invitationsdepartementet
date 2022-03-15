<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(RolesSeeder::class);
        $this->call(PreferencesSeeder::class);
        $this->call(RegionsSeeder::class);
        $this->call(StatusesSeeder::class);

        Model::reguard();
    }
}
