<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;
use App\route;
use App\rep;

class RouteController extends Controller {


    public function route_main(Request $request){


        $reps = Rep::all();

        $routes = DB::select(DB::raw("Select A.*, IFNULL((Select B.rep_name from reps B where B.id = A.id),0) as rep_name from routes A"));
        return view('Management.routes')
            ->with('reps', $reps)
            ->with('routes', $routes);


    }

    public function insert_routes(Request $request){


        $route = new Route;

        $route->route_name = $request->input('name');
        $route->start = $request->input('start');
        $route->end = $request->input('end');
        $route->rep_id = $request->input('rep');
        $route->remarks = $request->input('remarks');

        $route->save();

    }

    public function get_routes(Request $request){

         $routes = DB::select(DB::raw("Select A.*, IFNULL((Select B.rep_name from reps B where B.id = A.id),0) as rep_name from routes A"));

        return response()->json(['count' => count($routes), 'data' => $routes]);



    }
    
    public function edit_routes(Request $request){
        
        $id = $request->input('id');
        
        $route = Route::find($id);
        
        
        $route->route_name = $request->input('name');
        $route->start = $request->input('start');
        $route->end = $request->input('end');
        $route->rep_id = $request->input('rep');
        $route->remarks = $request->input('remarks');
        
        $route->save();
        
        
        
    }
    
    public function get_route_info(Request $request){
        
        $id = $request->input('id');
        
        $routes = Route::find($id);
        
        return $routes;
        
        
    }
    public function del_routes(Request $request){
        
        
        $id = $request->input('id');
        
        $routes = Route::find($id);
        
        $routes->delete();
        
    }
    


}
