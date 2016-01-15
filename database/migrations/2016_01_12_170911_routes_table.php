<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RoutesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
        
        Schema::create('routes', function(Blueprint $table){
			$table->increments('id');
			$table->string('route_name');
			$table->string('start')->nullable();
			$table->string('end')->nullable();
			$table->integer('rep_id')->nullable();
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
        Schema::drop('routes');
		//
	}

}
