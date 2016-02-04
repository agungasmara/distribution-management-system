<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;
use App\Brand;

class BrandController extends Controller
{
    //
        
    public function brand_main(Request $request){


        return view('Products.categories');

    }


    public function insert_brand(Request $request){


        $brand = new Brand;

        $brand->brand_name = $request->input('bname');
        $brand->manufacturer = $request->input('manu');
        
        $brand->remarks = $request->input('remarks');



        $brand->save();

    }

    public function get_brand(Request $request){

        $cat = DB::select(DB::raw("select A.*, (Select COUNT(*) from products B where B.brand_id = A.id) as count1 from brands A"));

        return response()->json(['count' => count($cat), 'data' => $cat]);



    }

    public function edit_brand(Request $request){

        $id = $request->input('id');

        $vehicle = Vehicle::find($id);


        $vehicle->vehicle_model = $request->input('model');
        $vehicle->vehicle_number = $request->input('vehi_num');
        $vehicle->vehicle_type = $request->input('type');
        $vehicle->remarks = $request->input('remarks');



        $vehicle->save();



    }

    public function get_brand_info(Request $request){

        $id = $request->input('id');

        $vehicle = Vehicle::find($id);

        return $vehicle;


    }

    public function del_brand(Request $request){


        $id = $request->input('id');

        $brand = Brand::find($id);

        $brand->delete();

    }

}
