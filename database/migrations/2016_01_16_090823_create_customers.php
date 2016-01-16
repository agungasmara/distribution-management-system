<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        
         Schema::create('customers', function(Blueprint $table){
			$table->increments('id');
			$table->string('cus_name');
			$table->string('nic')->nullable();
			$table->string('remarks')->nullable();
            $table->string('phone')->nullable();
            $table->string('home')->nullable(); 
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
           Schema::drop('customers');
    }
}
