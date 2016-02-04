2<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Products extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        
        
            Schema::create('products', function(Blueprint $table){
			$table->increments('id');
			$table->string('product_name');
			$table->integer('cat_id')->nullable();
            $table->integer('brand_id')->nullable();  
            //$table->integer('product_sub')->nullable();    
			//$table->string('manu_name')->nullable();
            $table->string('remarks')->nullable();
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
         Schema::drop('products');
    }
}
