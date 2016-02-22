<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Loadingmain extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        
         Schema::create('loading_main', function(Blueprint $table){
            $table->increments('id');
            $table->date('load_date');
            $table->integer('vehicle_id')->nullable();
            $table->integer('route_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->string('status')->default('ACTIVE');
            $table->date('unload_date')->nullable();
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
        
         Schema::drop('loading_main');
    }
}
