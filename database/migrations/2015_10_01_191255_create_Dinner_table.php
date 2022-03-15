<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDinnerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
            Schema::create('dinners', function(Blueprint $table)
            {
                $table->increments('id');
                $table->string('date');
                $table->integer('quantity_established');
                $table->integer('quantity_new');
                $table->integer('user_id');
                $table->integer('adress_id');
                $table->string('has_host');
                $table->timestamps();
            });
            
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('dinners');
    }
}
