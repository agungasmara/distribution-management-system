<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CustomerSalesProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        
        Schema::create('customer_sales_products', function(Blueprint $table){
			$table->increments('id');
			$table->string('sales_id');
			$table->string('product_id')->nullable();
            $table->string('product_name')->nullable();
            $table->double('original')->nullable(); 
            $table->double('qty')->nullable(); 
            $table->double('sold')->nullable(); 
            $table->double('total')->nullable(); 
            $table->double('diff')->nullable(); 
        
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
        
         Schema::drop('customer_sales_products');
    }
}
