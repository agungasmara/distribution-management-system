<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;
use App\route;
use App\rep;
use App\vehicle;
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


}
