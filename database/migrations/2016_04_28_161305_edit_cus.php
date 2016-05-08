<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditCus extends Migration
{
 /**
     * Run the migrations.
     *
     * @return void
     */
 public function up()
 {
  //


  Schema::table('customers', function($table){

   $table->date('outstanding_date')->nullable();

  });


  Schema::table('customer_sales', function($table){

   $table->integer('vehicle_id')->nullable();
   $table->double('exchange_amt')->nullable();
   $table->double('free_amt')->nullable();

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

  Schema::table('customers', function($table){


   $table->dropColumn('outstanding_date');


  });
  Schema::table('customer_sales', function($table){

   $table->dropColumn('vehicle_id');
   $table->dropColumn('exchange_amt');
   $table->dropColumn('free_am');

  });
 }
}
