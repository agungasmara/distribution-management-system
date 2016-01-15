<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RepsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
           Schema::create('reps', function(Blueprint $table){
			$table->increments('id');
			$table->string('rep_name');
			$table->string('nic')->nullable();
			$table->string('remarks')->nullable();
            $table->string('phone')->nullable();
            $table->string('image_location')->nullable();   
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
        Schema::drop('reps');
	}

}
