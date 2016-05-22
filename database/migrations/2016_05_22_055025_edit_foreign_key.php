<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditForeignKey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //

        Schema::table('stock_recieves', function ($table) {

            $table->dropForeign('stock_recieves_stock_id_foreign');

        });

        Schema::table('stock_recieves', function ($table) {

            $table->foreign('stock_id')->references('id')->on('stocks')->onDelete('cascade');
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


        Schema::table('stock_recieves', function ($table) {

            $table->dropForeign('stock_recieves_stock_id_foreign');

        });
    }
}
