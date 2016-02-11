<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\stock;
use App\SubProduct;
use App\StockMain;

class StockController extends Controller
{


    public function grn(){

        $products = DB::select(DB::raw("Select A.*, 
        (Select B.product_name from products B where B.id = A.id) as product_name
        From sub_products A"));

        return view('Stocks.grn')
            ->with('products',$products); 


    }

    public function get_grn(Request $request){

        $id = $request->input('id');

        $results = DB::select(DB::raw("SELECT A.*,
   			(SELECT CONCAT((SELECT C.product_name 
             			    FROM products C where C.id = B.pro_id),  '-', B.sub_name ) as abc
                    FROM sub_products B where B.id = A.sub_product_id
                    ) as pro_name
            FROM `stocks` A  WHERE A.stock_main_id = '$id'"));
        
         return response()->json(['count' => count( $results), 'data' =>  $results]);



    }

    public function main(Request $request){

        $products = DB::select(DB::raw("Select A.*, 
        (Select B.product_name from products B where B.id = A.id) as product_name
        From sub_products A"));

        return view('Stocks.stocks')
            ->with('products',$products);
    }


    public function insert_stock(Request $request){


        $stock = new stock;

        $stock->stock_main_id = $request->input('sid');
        $stock->sub_product_id = $request->input('product');
        $stock->remarks = $request->input('remarks');
        $stock->initial = $request->input('qty');
        $stock->available = $request->input('qty');
        $stock->expiry_date = $request->input('exp');


        $stock->save();

    }

    
    
    

    public function insert_stock_main(Request $request){


        $sm = new StockMain;

        $sm->stock_code = $request->input('grncode');
        $sm->remarks = $request->input('remarks');
        $sm->recieved_date = $request->input('rdate');


        $sm->save();

        return $sm->id;  

    }


    public function get_stock(Request $request){

        $reps = Rep::all();

        return response()->json(['count' => count($reps), 'data' => $reps]);



    }

    public function edit_stock(Request $request){

        $id = $request->input('id');

        $rep = Rep::find($id);


        $rep->rep_name = $request->input('name');
        $rep->nic = $request->input('nic');
        $rep->remarks = $request->input('remarks');
        $rep->phone = $request->input('phone');


        $rep->save();



    }

    public function get_stock_info(Request $request){

        $id = $request->input('id');

        $reps = Rep::find($id);

        return $reps;


    }


    public function del_grns(Request $request){


        $id = $request->input('id');

        $stock = stock::find($id);

        $stock->delete();

    }


    

}
