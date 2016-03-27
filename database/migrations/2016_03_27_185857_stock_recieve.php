<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class StockRecieve extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        
           Schema::create('stock_recieves', function(Blueprint $table){
            $table->increments('id');
               
               $table->integer('stock_id');
               $table->integer('recieved_qty');
               $table->date('recieved_date');
            
            
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
         Schema::drop('stock_recieves');
    }
}
