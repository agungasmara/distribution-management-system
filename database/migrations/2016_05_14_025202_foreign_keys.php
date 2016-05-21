<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ForeignKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //

        Schema::table('customer_sales', function ($table) {

            $table->integer('customer_id')->unsigned()->change();
            $table->foreign('customer_id')->references('id')->on('customers');
        });
        Schema::table('discard_items', function ($table) {

            $table->integer('product_id')->unsigned()->change();
            $table->foreign('product_id')->references('id')->on('sub_products');
        });

        Schema::table('loading_main', function ($table) {

            $table->integer('vehicle_id')->unsigned()->change();
            $table->integer('route_id')->unsigned()->change();
            $table->foreign('vehicle_id')->references('id')->on('vehicles');
            $table->foreign('route_id')->references('id')->on('routes');
        });

        Schema::table('load_items', function ($table) {

            $table->integer('sub_product_id')->unsigned()->change();
            $table->foreign('sub_product_id')->references('id')->on('sub_products');
        }); 

        Schema::table('products', function ($table) {

            $table->integer('brand_id')->unsigned()->change();
            $table->foreign('brand_id')->references('id')->on('brands');

            $table->integer('cat_id')->unsigned()->change();
            $table->foreign('cat_id')->references('id')->on('categories');
        });

        Schema::table('sales_load_items', function ($table) {

            $table->integer('product_id')->unsigned()->change();
            $table->foreign('product_id')->references('id')->on('sub_products');
            $table->integer('sales_load_main_id')->unsigned()->change();
            $table->foreign('sales_load_main_id')->references('id')->on('sales_load_main')->onDelete('cascade');
        });

        Schema::table('sales_load_main', function ($table) {
            $table->integer('load_main_id')->unsigned()->change();
            $table->foreign('load_main_id')->references('id')->on('loading_main');
        });




        Schema::table('stock_recieves', function ($table) {
            $table->integer('stock_id')->unsigned()->change();
            $table->foreign('stock_id')->references('id')->on('stock_main');
        });

        Schema::table('stocks', function ($table) {
            $table->integer('stock_main_id')->unsigned()->change();
            $table->foreign('stock_main_id')->references('id')->on('stock_main');


            $table->integer('sub_product_id')->unsigned()->change();
            $table->foreign('sub_product_id')->references('id')->on('sub_products');
        });
        Schema::table('sub_products', function ($table) {
            $table->integer('pro_id')->unsigned()->change();
            $table->foreign('pro_id')->references('id')->on('products');
        });


        Schema::table('customer_payments', function ($table) {
            $table->integer('customer_id')->unsigned()->change();
            $table->foreign('customer_id')->references('id')->on('customers');


            $table->integer('customer_sales_id')->unsigned()->change();
            $table->foreign('customer_sales_id')->references('id')->on('customer_sales');
        });


        Schema::table('customer_docs', function ($table) { 

            $table->integer('customer_sales_id')->unsigned()->change();
            $table->foreign('customer_sales_id')->references('id')->on('customer_sales');
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


        Schema::table('customer_sales', function ($table) {

            $table->dropForeign('customer_sales_customer_id_foreign');

        });
        Schema::table('discard_items', function ($table) {

            
             $table->dropForeign('discard_items_product_id_foreign');
             
        });

        Schema::table('loading_main', function ($table) {

            
              $table->dropForeign('loading_main_vehicle_id_foreign');
            
              $table->dropForeign('loading_main_route_id_foreign');
             
        });
/*
        Schema::table('load_items', function ($table) {

            $table->integer('sub_product_id')->unsigned()->change();
            $table->foreign('sub_product_id')->references('id')->on('sub_products');
        }); 

        Schema::table('products', function ($table) {

            $table->integer('brand_id')->unsigned()->change();
            $table->foreign('brand_id')->references('id')->on('brands');

            $table->integer('cat_id')->unsigned()->change();
            $table->foreign('cat_id')->references('id')->on('categories');
        });

        Schema::table('sales_load_items', function ($table) {

            $table->integer('product_id')->unsigned()->change();
            $table->foreign('product_id')->references('id')->on('sub_products');
            $table->integer('sales_load_main_id')->unsigned()->change();
            $table->foreign('sales_load_main_id')->references('id')->on('sales_load_main')->onDelete('cascade');
        });

        Schema::table('sales_load_main', function ($table) {
            $table->integer('load_main_id')->unsigned()->change();
            $table->foreign('load_main_id')->references('id')->on('loading_main');
        });




        Schema::table('stock_recieves', function ($table) {
            $table->integer('stock_id')->unsigned()->change();
            $table->foreign('stock_id')->references('id')->on('stock_main');
        });

        Schema::table('stocks', function ($table) {
            $table->integer('stock_main_id')->unsigned()->change();
            $table->foreign('stock_main_id')->references('id')->on('stock_main');


            $table->integer('sub_product_id')->unsigned()->change();
            $table->foreign('sub_product_id')->references('id')->on('sub_products');
        });
        Schema::table('sub_products', function ($table) {
            $table->integer('pro_id')->unsigned()->change();
            $table->foreign('pro_id')->references('id')->on('products');
        });


        Schema::table('customer_payments', function ($table) {
            $table->integer('customer_id')->unsigned()->change();
            $table->foreign('customer_id')->references('id')->on('customers');


            $table->integer('customer_sales_id')->unsigned()->change();
            $table->foreign('customer_sales_id')->references('id')->on('customer_sales');
        });


        Schema::table('customer_docs', function ($table) { 

            $table->integer('customer_sales_id')->unsigned()->change();
            $table->foreign('customer_sales_id')->references('id')->on('customer_sales');
        }); */

    }
}
