<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CustomerSalesPayment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        
        
         Schema::create('customer_payments', function(Blueprint $table){
            $table->increments('id');
            $table->integer('customer_id')->nullable();
            $table->integer('customer_sales_id')->nullable();
            $table->string('bill_num')->nullable();
            $table->string('chqnum')->nullable();
            $table->string('chqbank')->nullable();
            $table->string('status')->default('PENDING');
            $table->string('type');
  
            $table->date('chqdate')->nullable();
            $table->double('amount')->nullable();
            
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
         Schema::drop('customer_payments');
    }
}
