<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DiscardMain extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        
         Schema::create('discard_main', function(Blueprint $table){
            $table->increments('id');
            $table->string('reverse_grn')->nullable();
            $table->date('discard_date')->nullable();
            $table->integer('user_id')->nullable();
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
         Schema::drop('discard_main');
    }
}
