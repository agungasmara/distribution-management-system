<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Vehicles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        
        
            Schema::create('vehicles', function(Blueprint $table){
			$table->increments('id');
			$table->string('vehicle_model');
            $table->string('status')->default('AVAILABLE');
			$table->string('vehicle_number')->nullable();
			$table->string('vehicle_type')->nullable();
            $table->string('remarks')->nullable();
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
        //
        
        Schema::drop('vehicles');
    }
}
