<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Input;
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
use App\TempDocs;
use File;
use Session;
use App\CustomerDocs;
use App\CustomerPayment;
use App\CustomerSales;

class SalesController extends Controller
{
    //

    private $userid;
    private $sessionId;

    public function __construct(){

        $this->userid = "1";
        $this->sessionId = Session::getId();


    }


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
        //$salesMain->customer_id = $request->input('customer');
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


        $results = DB::select(DB::raw("select A.* 
        from sales_load_main A where A.load_main_id = '$id'"));



        return response()->json(['count' => count( $results), 'data' =>  $results]);


    }

    public function getdailysales(Request $request){

        $ldate = $request->input('ldate');


        $results = DB::select(DB::raw("select A.*, (select (select c.vehicle_number from vehicles c where c.id = b.vehicle_id) from loading_main b where b.id = a.load_main_id) as vehicle
from sales_load_main A where A.sale_date LIKE '$ldate'"));



        return response()->json(['count' => count( $results), 'data' =>  $results]);

    }

    public function getdailysalesCus(Request $request){

        $ldate = $request->input('ldate');


        $results = DB::select(DB::raw("SELECT A.*, (SELECT b.cus_name from customers b where b.id = A.customer_id) as customer FROM `customer_sales` A WHERE `date`  LIKE '$ldate'"));



        return response()->json(['count' => count( $results), 'data' =>  $results]);

    }

    public function daily_sales(){



        return view('Sales.daily');
    }

    public function customer_sales(){


        $customers = customer::all();

        $docs  = TempDocs::where('user_id',$this->userid)->get();

        foreach($docs as $d){

            File::delete($d->doc_path);

            TempDocs::destroy($d->id);

        }


        return view('Sales.customerSales')
            ->with('customers',$customers);

    }

    public function post_upload(Request $request){


        $abc = Input::all();

        $destinationPath = 'uploads/temp/'; // upload path
        $extension = Input::file('file')->getClientOriginalExtension(); // getting image extension
        $fileName = rand(11111,99999).'_'.date('YmdHis').'.'.$extension; // renameing image
        Input::file('file')->move($destinationPath, $fileName); // uploading file to given path

        $doc = new TempDocs;

        $doc->user_id = $this->userid;
        $doc->doc_path = $destinationPath ."".$fileName;
        $doc->filename = $fileName;

        $doc->save();

        return $doc->id;


    }

    public function docDelete(Request $request){

        $doc  = TempDocs::find($request->input('id'));

        File::delete($doc->doc_path);


        $doc->delete();


    }


    public function insert_customer_sales(Request $request){


        //save customer
        $sale = new CustomerSales;

        $sale->customer_id = $request->input('customer');
        $sale->bill_num = $request->input('bill');
        $sale->total = $request->input('total');
        $sale->due = $request->input('due');
        $sale->paid = $request->input('paid');
        $sale->date = $request->input('saledate');

        $sale->save();

        if($request->input('due') > 0){

            $cus =  customer::find($request->input('customer'));

            $cus->outstanding = ($cus->outstanding+$request->input('due'));

            $cus->save();

        }
        
        if($request->input('paid') > $request->input('total')){
            
            
            $cus =  customer::find($request->input('customer'));

            $cus->outstanding = ($cus->outstanding-($request->input('paid')- $request->input('total')));

            $cus->save();
            
        }

        //save payments

        $paymentArray = $request->input('payments');

        foreach($paymentArray as $p){

            $payment = new CustomerPayment;

            $payment->customer_sales_id =  $sale->id;
            $payment->customer_id =  $request->input('customer');
            $payment->bill_num =  $request->input('bill');
            $payment->chqnum =  $p['chknum'];
            $payment->chqdate =  $p['chkdate'];

            $payment->chqbank =  $p['bank'];
            $payment->amount =  $p['amount'];
            $payment->type =  $p['type'];

            if( $p['type'] == 'CASH'){
                $payment->status = "DONE";
            }
            else{
                $payment->status = "PENDING";
            }

            $payment->save();

        }


        //save docs

        $docs  = TempDocs::where('user_id',$this->userid)->get();


        foreach($docs as $d){

            $dest = 'uploads/documents/'.$d->filename;

            File::copy($d->doc_path, $dest);


            $newDoc = new CustomerDocs;

            $newDoc->customer_sales_id =  $sale->id;
            $newDoc->bill_num =  $request->input('bill');
            $newDoc->doc_path = $dest;


            $newDoc->save();

            File::delete($d->doc_path);

            TempDocs::destroy($d->id);

        }


    }
    
    
    public function customersales_view(Request $request){
        
        
        
        return "still under development";
        
    }

}
