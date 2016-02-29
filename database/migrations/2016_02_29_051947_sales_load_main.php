<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SalesLoadMain extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        
         Schema::create('sales_load_main', function(Blueprint $table){
            $table->increments('id');
            $table->integer('load_main_id')->nullable();
            $table->date('sale_date')->nullable();
            $table->integer('customer_id')->nullable();
            $table->integer('user_id')->nullable(); 
            $table->double('total')->nullable(); 
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
        Schema::drop('sales_load_main');
    }
}
