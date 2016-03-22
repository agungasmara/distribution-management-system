<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CustomerSales extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        
        
        
          Schema::create('customer_sales', function(Blueprint $table){
            $table->increments('id');
            $table->string('customer_id')->nullable();
            $table->string('bill_num')->nullable();
            $table->double('total')->nullable();
            $table->date('date')->nullable();
            $table->double('paid')->nullable();
            $table->double('due')->nullable();
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
        
         Schema::drop('customer_sales');
    }
}
