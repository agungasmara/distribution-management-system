<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CustomerSalesSummary extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
         
        
         Schema::create('customer_sales_summary', function(Blueprint $table){
			$table->increments('id');
			$table->string('sales_id');
			$table->string('bill_no')->nullable();
            $table->double('bill_total')->nullable();
            $table->double('original_total')->nullable(); 
            $table->double('difference')->nullable(); 
            $table->string('settle_ind')->default('NO'); 
        
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
        
         Schema::drop('customer_sales_summary');
        
        
    }
}
