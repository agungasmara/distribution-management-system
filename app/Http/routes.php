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

 
 Route::get('/reps', 'RepController@rep_main');
 
 Route::get('/insert-reps', 'RepController@insert_reps');
 Route::get('/get-reps', 'RepController@get_reps');
 Route::get('/get_rep_info', 'RepController@get_rep_info');
 Route::get('/edit_reps', 'RepController@edit_reps');
 
