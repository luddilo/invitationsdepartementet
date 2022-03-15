<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class StatusesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('statuses')->delete();

        $arr = [
            [
                'id' => 1,
                'name' => 'suggested',
                'description' => 'Suggested',
                'bootstrap_label_class' => 'label-info'
            ],
            [
                'id' => 2,
                'name' => 'approved',
                'description' => 'Approved',
                'bootstrap_label_class' => 'label-success'
            ],
            [
                'id' => 3,
                'name' => 'denied',
                'description' => 'Denied',
                'bootstrap_label_class' => 'label-warning'
            ]
        ];

        foreach ($arr as $data) {
            App\Models\Status::create([
                'name' => $data['name'],
                'description' => $data['description'],
                'bootstrap_label_class' => $data['bootstrap_label_class']
            ]);
        }
    }
}
