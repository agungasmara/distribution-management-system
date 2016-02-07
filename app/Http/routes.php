<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function(){
    
    
    return view('DEMO');
});

 
 Route::get('/routes', 'RouteController@route_main');
 Route::get('/insert-routes', 'RouteController@insert_routes');
 Route::get('/get-routes', 'RouteController@get_routes');
 Route::get('/get_route_info', 'RouteController@get_route_info');
 Route::get('/edit_routes', 'RouteController@edit_routes');
 Route::get('/del_routes', 'RouteController@del_routes');

 
 Route::get('/reps', 'RepController@rep_main');
 Route::get('/insert-reps', 'RepController@insert_reps');
 Route::get('/get-reps', 'RepController@get_reps');
 Route::get('/get_rep_info', 'RepController@get_rep_info');
 Route::get('/edit_reps', 'RepController@edit_reps');
 Route::get('/del_reps', 'RepController@del_reps');


 Route::get('/customers', 'CustomerController@customer_main');
 Route::get('/insert-customer', 'CustomerController@insert_customer');
 Route::get('/get-customer', 'CustomerController@get_customer');
 Route::get('/get_customer_info', 'CustomerController@get_customer_info');
 Route::get('/edit_customer', 'CustomerController@edit_customer');
 Route::get('/del_customer', 'CustomerController@del_customer');
 

 Route::get('/vehicles', 'VehicleController@vehicle_main');
 Route::get('/insert-vehicles', 'VehicleController@insert_vehicles');
 Route::get('/get-vehicles', 'VehicleController@get_vehicles');
 Route::get('/get_vehicle_info', 'VehicleController@get_vehicle_info');
 Route::get('/edit_vehicles', 'VehicleController@edit_vehicles');
 Route::get('/del_vehicles', 'VehicleController@del_vehicles');




 Route::get('/categories', 'CategoryController@category_main');
 Route::get('/insert-category', 'CategoryController@insert_category');
 Route::get('/get-category', 'CategoryController@get_category');
 Route::get('/get_category_info', 'CategoryController@get_category_info');
 Route::get('/edit_category', 'CategoryController@edit_category');
 Route::get('/del_category', 'CategoryController@del_category');

 Route::get('/insert-brand', 'BrandController@insert_brand');
 Route::get('/get-brand', 'BrandController@get_brand');
 Route::get('/get_brand_info', 'BrandController@get_brand_info');
 Route::get('/edit_brand', 'BrandController@edit_brand');
 Route::get('/del_brand', 'BrandController@del_brand');





 Route::get('/products', 'ProductController@product_main');
 Route::get('/insert-product', 'ProductController@insert_product');
 Route::get('/insert-sproduct', 'ProductController@insert_sproduct');
 Route::get('/get-subproduct', 'ProductController@get_subproduct');
 Route::get('/get_product_info', 'ProductController@get_product_info');
 Route::get('/edit_product', 'ProductController@edit_product');
 Route::get('/del_sp', 'ProductController@del_sp');

 Route::get('/get-products', 'ProductController@get_products');
 Route::get('/get-subproducts', 'ProductController@get_subproducts');


 Route::get('/astocks', 'StockController@main');
 Route::get('/insert-stock', 'StockController@insert_stock');
 Route::get('/get-stock', 'StockController@get_stock');
 Route::get('/get_stock_info', 'StockController@get_stock_info');
 Route::get('/edit_stock', 'StockController@edit_stock');
 Route::get('/del_stock', 'StockController@del_stock');
