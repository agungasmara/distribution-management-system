<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;
use App\Product;
use App\SubProduct;
use App\Brand;
use App\Category;



class ProductController extends Controller
{
    //



    public function product_main(Request $request){


        $cat = Category::all();
        $brand = Brand::all();

        return view('Products.products')
            ->with('brand',$brand)        
            ->with('cat',$cat);

    }


    public function insert_product(Request $request){


        $product = new Product;

        $product->product_name = $request->input('pname');
        $product->brand_id = $request->input('pbrand');
        $product->cat_id = $request->input('pcat');
        $product->remarks = $request->input('premarks');


        $product->save();

        return $product->id;

    }


    public function insert_sproduct(Request $request){


        $sproduct = new SubProduct;

        $sproduct->sub_name = $request->input('sname');
        $sproduct->pro_id = $request->input('pid');
        $sproduct->price = $request->input('sprice');
        $sproduct->buying_price = $request->input('sbprice');
        $sproduct->remarks = $request->input('sremarks');


        $sproduct->save();



    }

    public function get_subproduct(Request $request){

        $id = $request->input('id');

        $sp= DB::select(DB::raw("SELECT * FROM `sub_products` A WHERE  `pro_id` = '$id'"));

        return response()->json(['count' => count($sp), 'data' => $sp]);



    }
    
        public function get_subproducts(Request $request){

      

        $sp = DB::select(DB::raw("SELECT A.*, 
        (Select B.product_name from `products` B where B.id = A.pro_id ) as product_name 
        FROM `sub_products` A "));

        return response()->json(['count' => count($sp), 'data' => $sp]);



    }
        public function get_products(Request $request){


        $products= DB::select(DB::raw("SELECT A.*,
        IFNULL((Select B.brand_name From `brands` B where B.id = A.brand_id  ),'NOT SET') as brand_name, 
        IFNULL((Select C.cat_name from `categories` C where C.id = A.cat_id),'NOT SET') as cat_name,
        (SELECT count(*) from `sub_products` S where S.pro_id = A.id) as subcount
        FROM `products` A"));

        return response()->json(['count' => count($products), 'data' => $products]);



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

    public function del_sp(Request $request){


        $id = $request->input('id');

        $sp = SubProduct::find($id);

        $sp->delete();

    }
    public function del_product(Request $request){
        
        
        $id = $request->input('id');

        $p = Product::find($id);

        $p->delete();
        
    }

}
