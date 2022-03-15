<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Models\Email;

class RemoveDinnerEmailTable extends Migration
{
    protected function migrateData()
    {
        $rows = \DB::table('dinner_email')->get();

        foreach ($rows as $row) {
            Email::where('id', $row->email_id)->update([
                'dinner_id' => $row->dinner_id,
            ]);
        }
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->migrateData();

        Schema::drop('dinner_email');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('dinner_email', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('dinner_id');
            $table->unsignedInteger('email_id');
        });
    }
}
