<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditSales extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        
        
           Schema::table('sales_load_items', function($table){

           
            $table->double('market_return')->nullable();
            $table->double('good_return')->nullable();
            $table->double('exchange')->nullable();
            $table->double('sold')->nullable();
           
          
           

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
        
         Schema::table('sales_load_items', function($table){

           
           
            $table->dropColumn('market_return');
            $table->dropColumn('good_return');
            $table->dropColumn('exchange');
            $table->dropColumn('sold');
          
           

        });
    }
}
