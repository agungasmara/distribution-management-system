<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;
use App\route;
use App\rep;
use App\vehicle;
use App\loadItem;
use App\loadMain;
use App\SubProduct;
use App\stock;

class VehicleController extends Controller
{
    //


    public function vehicle_main(Request $request){


        return view('Management.vehicles');

    }


    public function insert_vehicles(Request $request){


        $vehicle = new Vehicle;

        $vehicle->vehicle_model = $request->input('model');
        $vehicle->vehicle_number = $request->input('vehi_num');
        $vehicle->vehicle_type = $request->input('type');
        $vehicle->remarks = $request->input('remarks');



        $vehicle->save();

    }

    public function get_vehicles(Request $request){

        $reps = Vehicle::all();

        return response()->json(['count' => count($reps), 'data' => $reps]);



    }

    public function edit_vehicles(Request $request){

        $id = $request->input('id');

        $vehicle = Vehicle::find($id);


        $vehicle->vehicle_model = $request->input('model');
        $vehicle->vehicle_number = $request->input('vehi_num');
        $vehicle->vehicle_type = $request->input('type');
        $vehicle->remarks = $request->input('remarks');



        $vehicle->save();



    }

    public function get_vehicle_info(Request $request){

        $id = $request->input('id');

        $vehicle = Vehicle::find($id);

        return $vehicle;


    }

    public function del_vehicles(Request $request){


        $id = $request->input('id');

        $vehicle = Vehicle::find($id);

        $vehicle->delete();

    }


    public function load(Request $request){


        return view('LoadUnload.load');
    }

    public function active_vehicles(Request $request){

        $vehicle = Vehicle::where('status', 'AVAILABLE')->get();

        return response()->json(['count' => count($vehicle), 'data' => $vehicle]);

    }
    public function load_vehicle(Request $request){


        $routes = route::all();
        $vehicle = vehicle::find($request->input('id'));

        $products = DB::select(DB::raw("Select A.*, (Select B.product_name from products B where B.id = A.id) as product_name, (Select SUM(C.available) from `stocks` C where C.sub_product_id = A.id AND C.status = 'ACTIVE' ) as available From sub_products A"));

        return view('LoadUnload.loadview')
            ->with('vehicle',$vehicle)
            ->with('products',$products)
            ->with('routes',$routes);
    }

    public function insert_load(Request $request){

        //var_dump($request->input('data'));

        $loadMain = new loadMain;

        $loadMain->vehicle_id = $request->input('vid');
        $loadMain->route_id  =    $request->input('route');
        $loadMain->load_date =  date('Y-m-d');

        $loadMain->save();


        $vehicle = vehicle::find($request->input('vid'));
        $vehicle->status = 'LOADED';
        $vehicle->save();

        $id =  $loadMain->id;


        $data = $request->input('data');

        foreach ($data as $d){


            $stocks = stock::where('status','ACTIVE')
                ->where('sub_product_id', $d['product_id'])
                ->where('available', '>', '0')
                ->orderBy('expiry_date','ASC')
                ->first();






            $item = new loadItem;

            $item->load_main_id = $id;
            $item->sub_product_id = $d['product_id'];
            $item->number =$d['quantity'];
            $item->stock_id = $stocks->id;
            $item->save();

            $stockUpdate = stock::find($stocks->id);
            $stockUpdate->available = ($stocks->available - $d['quantity']);

            $stockUpdate->save();



        }



    }

}
