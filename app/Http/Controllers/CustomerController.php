<?php


namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;
use App\route;
use App\rep;
use App\customer;


class CustomerController extends Controller
{
    //
    
    
    public function customer_main(Request $request){
      
        return  view('Management.customer');
     
    }
    
    
    
     public function insert_customer(Request $request){


        $cus = new Customer;

        $cus->cus_name = $request->input('name');
        $cus->nic = $request->input('nic');
        $cus->remarks = $request->input('remarks');
        $cus->phone = $request->input('phone');
        $cus->home = $request->input('home');
        $cus->address1 = $request->input('add1');
        $cus->address2 = $request->input('add2');
        $cus->address3 = $request->input('add3');
        $cus->email = $request->input('email');
         
       

        $cus->save();

    }

    public function get_customer(Request $request){

         $reps = Customer::all();
       
        return response()->json(['count' => count($reps), 'data' => $reps]);



    }
    
    public function edit_customer(Request $request){
        
        $id = $request->input('id');
        
        $cus = Customer::find($id);
        
        
        $cus->cus_name = $request->input('name');
        $cus->nic = $request->input('nic');
        $cus->remarks = $request->input('remarks');
        $cus->phone = $request->input('phone');
        $cus->home = $request->input('home');
        $cus->address1 = $request->input('add1');
        $cus->address2 = $request->input('add2');
        $cus->address3 = $request->input('add3');
        $cus->email = $request->input('email');
         
       

        $cus->save();
        
        
        
    }
    
    public function get_customer_info(Request $request){
        
        $id = $request->input('id');
        
        $reps = Customer::find($id);
        
        return $reps;
        
        
    }


    
    
    
    
    
    
    
}
