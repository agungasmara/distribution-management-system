<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SalesLoadItems extends Migration
{
 /**
     * Run the migrations.
     *
     * @return void
     */
 public function up()
 {
  //
  Schema::create('sales_load_items', function(Blueprint $table){
   $table->increments('id');
   $table->integer('sales_load_main_id')->nullable();
   $table->integer('product_id')->nullable();
   $table->integer('quantity')->nullable(); 
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
  Schema::drop('sales_load_items');
 }
}
