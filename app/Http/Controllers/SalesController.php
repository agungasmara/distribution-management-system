<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;
use App\route;
use App\rep;
use App\customer;
use App\vehicle;
use App\loadItem;
use App\loadMain;
use App\SubProduct;
use App\stock;
use App\salesLoadMain;
use App\salesLoadItem;

class SalesController extends Controller
{
    //


    public function sales(Request $request){

        $customers = customer::all();

        $loadMain = loadMain::where('status','ACTIVE')
            ->where('vehicle_id',$request->input('id'))->first();


        $id = $loadMain->id;

        $products = DB::select(DB::raw("Select A.*,
        (Select CONCAT((Select C.product_name FROM `products` C where C.id = X.pro_id),'-',X.sub_name)
         as name  FROM `sub_products` X where X.id = A.sub_product_id)  as sub_name,
         (Select B.price From `sub_products` B where B.id = A.sub_product_id ) as price

        from `load_items` A where A.load_main_id   = '$id'"));



        return view('Sales.sales') 
            ->with('customers',$customers)
            ->with('products',$products)
            ->with('loadid',$id);
    }

    public function insert_sales_all(Request $request){

        $salesMain = new salesLoadMain;

        $salesMain->total = $request->input('total');
        $salesMain->customer_id = $request->input('customer');
        $salesMain->sale_date = $request->input('saledate');
        $salesMain->load_main_id = $request->input('loadid');
        $salesMain->discount = $request->input('fdiscount');
        $salesMain->remarks = $request->input('remarks');
        
        $salesMain->save();

        $id =  $salesMain->id;

        $data = $request->input('items');
        
        
         
        foreach($data as $d){

            $item = new salesLoadItem;

            $item->sales_load_main_id = $id;
            $item->product_id = $d['product'];
            $item->quantity = $d['qty'];
            $item->total = $d['amount'];
            $item->free = $d['free'];
            $item->discount = $d['discount'];
            $item->save();

            $tbid = $d['tblid'];
 
            $loadItem = loadItem::find($tbid);

            $loadItem->available_qty = ($loadItem->available_qty - $d['qty']);

            $loadItem->save(); 
        }


    }
    
    public function getsaleshisotry(Request $request){
        
        $id = $request->input('id');
        
        
        $results = DB::select(DB::raw("select A.*,(select cus_name from customers B where B.id = A.customer_id) as cus_name
        from sales_load_main A where A.load_main_id = '$id'"));
        
        
      
        return response()->json(['count' => count( $results), 'data' =>  $results]);

        
    }
    
    public function getdailysales(Request $request){
        
          $ldate = $request->input('ldate');
        
        
        $results = DB::select(DB::raw("select A.*,(select cus_name from customers B where B.id = A.customer_id) as cus_name
        from sales_load_main A where A.sale_date LIKE '$ldate'"));
        
        
      
        return response()->json(['count' => count( $results), 'data' =>  $results]);
        
    }
    
    public function daily_sales(){
        
        
        
        return view('Sales.daily');
    }

}
