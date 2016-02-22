<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Loaditems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        
        
          Schema::create('load_items', function(Blueprint $table){
            $table->increments('id');
            $table->integer('load_main_id')->nullable();
            $table->integer('sub_product_id')->nullable();
            $table->integer('stock_id')->nullable();
            $table->integer('number')->nullable();
            $table->integer('unload_qty')->nullable(); 
            $table->string('unload_remarks')->nullable(); 
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
        
         Schema::drop('load_items');
    }
}
