<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVendor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        
          Schema::create('vendors', function(Blueprint $table){
			$table->increments('id');
			$table->string('vendor_name');
			$table->string('remarks')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable(); 
            $table->string('address1')->nullable(); 
            $table->string('address2')->nullable();
            $table->string('address3')->nullable();
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
          Schema::drop('vendors');
    }
}
