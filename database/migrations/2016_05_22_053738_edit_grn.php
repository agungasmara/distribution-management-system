<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditGrn extends Migration
{
 /**
     * Run the migrations.
     *
     * @return void
     */
 public function up()
 {
  //

  Schema::table('stock_main', function($table){

   $table->integer('vendor_id')->nullable();


  });
  Schema::table('stock_main', function($table){

   $table->integer('vendor_id')->unsigned()->change();
   $table->foreign('vendor_id')->references('id')->on('vendors');
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


  Schema::table('stock_main', function($table){



   $table->dropForeign('stock_main_vendor_id_foreign');
   $table->dropColumn('vendor_id');



  });
 }
}
