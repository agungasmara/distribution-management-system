<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\vehicle;

class ReportController extends Controller
{
    public function SalesItemWise(){

        $vehicle = vehicle::all();

        return view('Reports.sales_summary_itemwise')
            ->with('vehicles',$vehicle);

    }

    public function sales_summary_itemwise_info(Request $request){


        $start = $request->input('start');
        $end = $request->input('end');
        $vehicle = $request->input('vehicle');

        $results = DB::select(DB::raw("select sales_load_items.product_id, 
(Select CONCAT((Select C.product_name FROM `products` C where C.id = X.pro_id),'-',X.sub_name)
as name  FROM `sub_products` X where X.id = sales_load_items.product_id)  as sub_name,



SUM(sales_load_items.market_return + sales_load_items.good_return + sales_load_items.sold + sales_load_items.free - sales_load_items.exchange ) as qty, 

 FORMAT(SUM(sales_load_items.market_return + sales_load_items.good_return + sales_load_items.sold + sales_load_items.free - sales_load_items.exchange ) * (select sub_products.price from sub_products where sub_products.id = sales_load_items.product_id ),2) as qty_amt,



SUM(sales_load_items.free) as free, 

FORMAT(SUM(sales_load_items.free) * (select sub_products.price from sub_products where sub_products.id = sales_load_items.product_id ),2) as free_amt, 


SUM(sales_load_items.market_return) as mr,

FORMAT(SUM(sales_load_items.market_return) * (select sub_products.price from sub_products where sub_products.id = sales_load_items.product_id ),2)  as mr_amt,
SUM(sales_load_items.good_return) as gr, 

FORMAT(SUM(sales_load_items.good_return) * (select sub_products.price from sub_products where sub_products.id = sales_load_items.product_id ),2)  as gr_amt, 
SUM(sales_load_items.exchange) as ex,

FORMAT(SUM(sales_load_items.exchange) * (select sub_products.price from sub_products where sub_products.id = sales_load_items.product_id ),2)  as ex_amt,
SUM(sales_load_items.sold) as sold,

FORMAT(SUM(sales_load_items.sold) * (select sub_products.price from sub_products where sub_products.id = sales_load_items.product_id ),2)  as  sold_amt
from sales_load_items
where sales_load_items.sales_load_main_id IN (SELECT a.id FROM sales_load_main a where a.sale_date between '$start' AND '$end' AND a.load_main_id IN (select C.id from loading_main C where C.vehicle_id = '$vehicle' ))
GROUP BY sales_load_items.product_id;
"));

        return response()->json(['count' => count($results), 'data' => $results]);

    }

    public function SalesCustomerWise(){



        $vehicle = vehicle::all();
        return view('Reports.sales_summary_customerwise')
            ->with('vehicles',$vehicle);
    }



    public function sales_summary_customerwise_info(Request $request){

        $start = $request->input('start');
        $end = $request->input('end');
        $vehicle = $request->input('vehicle');

        $results = DB::select(DB::raw("select 
A.customer_id,
(Select c.cus_name from customers c where c.id = A.customer_id) as cus_name,
IFNULL(FORMAT((SUM(A.free_amt) + SUM(A.market_return) + SUM(A.good_return) + SUM(A.discount) + SUM(A.total) - SUM(A.exchange_amt)) , 2),0)  as bill_amount,
IFNULL(FORMAT(SUM(A.free_amt) , 2),0)  as free,
IFNULL(FORMAT(SUM(A.market_return) , 2),0)  as mr,
IFNULL(FORMAT(SUM(A.good_return)  , 2),0) as gr,
IFNULL(FORMAT(SUM(A.exchange_amt) , 2),0)  as ex,
IFNULL(FORMAT(SUM(A.discount)  , 2),0) as discount,
IFNULL(FORMAT(SUM(A.total)  , 2),0) as total

from customer_sales A
where A.vehicle_id ='$vehicle'
AND A.date between '$start' AND '$end'
group by A.customer_id"));

        return response()->json(['count' => count($results), 'data' => $results]);

    }

    public function SalesUnpaid(){



        $vehicle = vehicle::all();
        return view('Reports.sales_unpaid')
            ->with('vehicles',$vehicle);
    }

    public function SalesInvoice(){

        $vehicle = vehicle::all();
        return view('Reports.invoice_report')
            ->with('vehicles',$vehicle);

    }

    public function unpaidReport(Request $request){


        $start = $request->input('start');
        $end = $request->input('end');
        $vehicle = $request->input('vehicle');

        $results =    DB::select(DB::raw("
        Select A.*,
        FORMAT(A.total,2) as net_total,
(select cus_name from customers B where B.id = A.customer_id) as customer,
datediff(NOW(),A.date) as age
from customer_sales A
where A.due > 0
AND A.vehicle_id = '$vehicle'
AND A.date between '$start' AND '$end'
        "));

        return response()->json(['count' => count($results), 'data' => $results]);
    }

    public function sales_summary_invoice_report(Request $request){


        $start = $request->input('start');
        $end = $request->input('end');
        $vehicle = $request->input('vehicle');

        if($vehicle != '0'){    

            $results =    DB::select(DB::raw("
        Select A.*,
FORMAT(A.total,2) as net_total,
(select cus_name from customers B where B.id = A.customer_id) as customer,
IFNULL((select vehicle_number from vehicles B where B.id = A.vehicle_id ),'N/A') as vehicle_number
from customer_sales A
where A.due > 0
AND A.vehicle_id = '$vehicle'
AND A.date between '$start' AND '$end'
        "));
        }else{

            $results =    DB::select(DB::raw("
        Select A.*,
FORMAT(A.total,2) as net_total,
(select cus_name from customers B where B.id = A.customer_id) as customer,
IFNULL((select vehicle_number from vehicles B where B.id = A.vehicle_id ),'N/A') as vehicle_number
from customer_sales A
WHERE  A.date between '$start' AND '$end';
        "));  

        }

        return response()->json(['count' => count($results), 'data' => $results]);
    }

}
