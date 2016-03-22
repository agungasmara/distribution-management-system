<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CustomerSalesDocs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        
            Schema::create('customer_docs', function(Blueprint $table){
            $table->increments('id');
            $table->integer('customer_sales_id')->nullable();
            $table->string('bill_num')->nullable();
            $table->string('doc_path')->nullable();
            
            
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
         Schema::drop('customer_docs');
    
    }
}
