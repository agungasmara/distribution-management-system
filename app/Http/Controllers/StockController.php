<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\stock;
use App\SubProduct;
use App\StockMain;
use App\discardItem;
use App\discardMain;

class StockController extends Controller
{


    public function grn(){

        $products = DB::select(DB::raw("Select A.*, 
        (Select B.product_name from products B where B.id = A.pro_id) as product_name
        From sub_products A"));

        return view('Stocks.grn')
            ->with('products',$products); 


    }

    public function discard(){


        $products = DB::select(DB::raw("Select A.*, 
        (Select B.product_name from products B where B.id = A.pro_id) as product_name,
        (Select SUM(X.available) from `stocks` X where X.sub_product_id = A.id AND X.status = 'ACTIVE' ) as available
        From sub_products A
        HAVING available > 0"));

        return view('Stocks.discard')
            ->with('products',$products); 


    }
    public function insert_discard(Request $request){

        $discardMain = new discardMain;

        $discardMain->reverse_grn = $request->input('grncode');
        $discardMain->discard_date = $request->input('ddate');
        $discardMain->remarks = $request->input('remarks');

        $discardMain->save();

        $id = $discardMain->id;

        $items = $request->input('data');

        foreach($items as $i){






            $extra = 10;
            $iteration = 0;
            while($extra != 0){

                
                
                $stocks = stock::where('status','ACTIVE')
                    ->where('sub_product_id', $i['product_id'])
                    ->where('available', '>', '0')
                    ->orderBy('expiry_date','ASC')
                    ->first();
            
              


                if( $iteration  == 0){
                    $discardItem = new discardItem;

                    $discardItem->product_id = $i['product_id'];
                    $discardItem->quantity = $i['quantity'];
                    $discardItem->discard_main_id = $id;
                    $discardItem->stock_id = $stocks->id;
                    $discardItem->save();
                    $iteration++;
                }
                
                
                
                
                $stockUpdate = stock::find($stocks->id);

                if(($stocks->available - $i['quantity']) > 0){

                    $stockUpdate->available = ($stocks->available - $i['quantity']);
                    $extra = 0;    
                }else{

                    $i['quantity'] =  ($i['quantity'] - $stockUpdate->available);
                    $stockUpdate->available = '0';
                    $stockUpdate->status = 'OVER';    

                }

                $stockUpdate->save();
                
             

            }



        }


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





    public function del_grns(Request $request){


        $id = $request->input('id');

        $stock = stock::find($id);

        $stock->delete();

    }

    public function get_activestocks(){

        $results = DB::select(DB::raw("Select A.* ,
        (Select B.product_name From products B where B.id = A.pro_id) as product_name,
        (Select SUM(C.available) From stocks C where C.sub_product_id = A.id AND C.status = 'ACTIVE') as count1
        from sub_products A"));

        return response()->json(['count' => count($results), 'data' => $results]);

    }

    public function stock_history(){


        return view('Stocks.stockHistory');
    }

    public function get_stock_history(){

        $stocks = StockMain::orderBy('recieved_date','DESC')->get();
        return response()->json(['count' => count($stocks), 'data' => $stocks]);

    }

    public function get_stock_info(Request $request){

        $id = $request->input('id');

        $results = DB::select(DB::raw("SELECT A.*,
   			(SELECT CONCAT((SELECT C.product_name 
             			    FROM products C where C.id = B.pro_id),  '-', B.sub_name ) as abc
                    FROM sub_products B where B.id = A.sub_product_id
                    ) as pro_name
            FROM `stocks` A  WHERE A.stock_main_id = '$id'"));

        return response()->json(['count' => count($results), 'data' => $results]);

    }

}
