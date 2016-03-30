<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditCustomerSales extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        
         Schema::table('customer_sales', function($table){

            $table->double('gross_sales')->nullable();
            $table->double('market_return')->nullable();
            $table->double('good_return')->nullable();
            $table->double('discount')->nullable();
           
          
           

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
        
         Schema::table('customer_sales', function($table){

            $table->dropColumn('gross_sales');
            $table->dropColumn('market_return');
            $table->dropColumn('good_return');
            $table->dropColumn('discount');
           
          
           

        });
    }
}
