<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TempDocs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        
          Schema::create('temp_docs', function(Blueprint $table){
            $table->increments('id');
            $table->string('session_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->string('doc_path')->nullable();
            $table->string('filename')->nullable();
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
        
         Schema::drop('temp_docs');
    }
}
