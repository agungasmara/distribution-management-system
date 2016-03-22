<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditSalesLoadMain extends Migration
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

            $table->dropColumn('customer_id');
          
           

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

            $table->integer('customer_id')->nullable();
          
           

        });
    }
}
