<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;
use App\route;
use App\rep;

class RepController extends Controller
{
    //
    
    
    public function rep_main(Request $request){
        
      
        return view('Management.reps');
        
    }
    
    
     public function insert_reps(Request $request){


        $rep = new Rep;

        $rep->rep_name = $request->input('name');
        $rep->nic = $request->input('nic');
        $rep->remarks = $request->input('remarks');
        $rep->phone = $request->input('phone');
       

        $rep->save();

    }

    public function get_reps(Request $request){

         $reps = Rep::all();
       
        return response()->json(['count' => count($reps), 'data' => $reps]);



    }
    
    public function edit_reps(Request $request){
        
        $id = $request->input('id');
        
        $rep = Rep::find($id);
        
        
        $rep->rep_name = $request->input('name');
        $rep->nic = $request->input('nic');
        $rep->remarks = $request->input('remarks');
        $rep->phone = $request->input('phone');
       
        
        $rep->save();
        
        
        
    }
    
    public function get_rep_info(Request $request){
        
        $id = $request->input('id');
        
        $reps = Rep::find($id);
        
        return $reps;
        
        
    }


    
    
}
