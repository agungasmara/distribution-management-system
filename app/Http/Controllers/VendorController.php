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
use App\vendor;

class VendorController extends Controller
{
    //

    public function vendors(){


        return view('Management.vendor');
    }



    public function save_vendor(Request $request){


        $vendor = new vendor;

        $vendor->vendor_name = $request->input('name');
        $vendor->phone = $request->input('phone');
        $vendor->remarks = $request->input('remarks');
        $vendor->email = $request->input('email'); 
        $vendor->address1 = $request->input('address1'); 
        $vendor->address2 = $request->input('address2'); 
        $vendor->address3 = $request->input('address3'); 

        $vendor->save();
    }

    public function get_vendors(){


        $v = vendor::all();


        return response()->json(['count' => count($v), 'data' => $v]);


    }

    public function update_vendor(Request $request){

        $vendor = vendor::find($request->input('id'));

        $vendor->vendor_name = $request->input('name');
        $vendor->phone = $request->input('phone');
        $vendor->remarks = $request->input('remarks');
        $vendor->email = $request->input('email'); 
        $vendor->address1 = $request->input('address1'); 
        $vendor->address2 = $request->input('address2'); 
        $vendor->address3 = $request->input('address3'); 

        $vendor->save();



    }


    public function vendor_get_info(Request $request){

        $vendor = vendor::find($request->input('id'));


        return $vendor;

    }


    public function vendor_delete(Request $request){

        $vendor = vendor::find($request->input('id'));
        $vendor->delete();
    }

}
