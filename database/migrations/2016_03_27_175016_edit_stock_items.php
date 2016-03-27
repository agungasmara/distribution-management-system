<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditStockItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        
          Schema::table('stocks', function($table){

            $table->integer('pending')->nullable();
            $table->integer('recieved')->nullable();
          
           

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
        
          Schema::table('stocks', function($table){

            $table->dropColumn('pending');
            $table->dropColumn('recieved');
          
           

        });
    }
}
