<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
    //
    
    
    public function category_main(Request $request){


        return view('Products.categories');

    }


    public function insert_category(Request $request){


        $cat = new Category;

        $cat->cat_name = $request->input('cname');
        $cat->remarks = $request->input('remarks');
        $cat->save();

    }

    public function get_category(Request $request){

        $cat = DB::select(DB::raw("select A.*, (Select COUNT(*) from products B where B.cat_id = A.id) as count1 from categories A"));

        return response()->json(['count' => count($cat), 'data' => $cat]);



    }

    public function edit_category(Request $request){

        $id = $request->input('id');

        $vehicle = Vehicle::find($id);


        $vehicle->vehicle_model = $request->input('model');
        $vehicle->vehicle_number = $request->input('vehi_num');
        $vehicle->vehicle_type = $request->input('type');
        $vehicle->remarks = $request->input('remarks');



        $vehicle->save();



    }

    public function get_category_info(Request $request){

        $id = $request->input('id');

        $vehicle = Vehicle::find($id);

        return $vehicle;


    }

    public function del_category(Request $request){


        $id = $request->input('id');

        $cat = Category::find($id);

        $cat->delete();

    }

    
    
}
