<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DiscardItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
         Schema::create('discard_items', function(Blueprint $table){
            $table->increments('id');
            $table->integer('product_id')->nullable();
            $table->integer('qunatity')->nullable();
            $table->integer('discard_main_id')->nullable();
            $table->integer('stock_id')->nullable(); 
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
         Schema::drop('discard_items');
    }
}
