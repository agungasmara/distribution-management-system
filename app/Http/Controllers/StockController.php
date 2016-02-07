<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\stock;
use App\SubProduct;

class StockController extends Controller
{
    
        
    public function main(Request $request){
        
        $products = DB::select(DB::raw("Select A.*, 
        (Select B.product_name from products B where B.id = A.id) as product_name
        From sub_products A"));
        
        return view('Stocks.stocks')
            ->with('products',$products);
    }
    
    
     public function insert_stock(Request $request){


        $stock = new stock;

        $stock->stock_code = $request->input('code');
        $stock->sub_product_id = $request->input('product');
        $stock->remarks = $request->input('remarks');
        $stock->initial = $request->input('qty');
        $stock->initial = $request->input('qty');
        $stock->expiry_date = $request->input('exp');
         

        $stock->save();

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
    
    
        public function del_stock(Request $request){
        
        
        $id = $request->input('id');
        
        $reps = Rep::find($id);
        
        $reps->delete();
        
    }
    

}
