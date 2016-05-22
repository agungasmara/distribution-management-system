<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditNewSales extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        
        Schema::table('sales_load_main', function($table){

            $table->double('discount')->nullable();
            $table->string('remarks')->nullable();
           
        });
      
          Schema::table('sales_load_items', function($table){

            $table->double('discount')->nullable();
            $table->integer('free')->nullable();
           
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
         Schema::table('sales_load_main', function($table){

            $table->dropColumn('discount');
            $table->dropColumn('remarks');
           

        });
        
          Schema::table('sales_load_items', function($table){

            $table->dropColumn('discount');
            $table->dropColumn('free');
           

        });
    }
}
