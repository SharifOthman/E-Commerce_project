<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use DB ;
use App\User;


class ProductsController extends Controller
{
    public function index()
    {
        $products=Product::all();
        foreach ($products as $product) {
            $b_date=Carbon::today();
            $f_date=Carbon::parse($product->exp_date);
             if($f_date->Ispast())
            {
                $product-> delete();
            }
            if($b_date->diffInDays($f_date)<=$product->pe3)
            {
                $product->price=$product->price-($product->price*$product->discount_pe3/100);
                $product->check=1;
                $product->save();


            }
            elseif($b_date->diffInDays($f_date)<=$product->pe2)
            {
                $product->price=$product->price-($product->price*$product->discount_pe2/100);
                 $product->check=1;
                 $product->save();



            }
            elseif($b_date->diffInDays($f_date)<=$product->pe1)
            {
                $product->price=$product->price-($product->price*$product->discount_pe1/100);
                $product->check=1;
                $product->save();


            }
        }
        return $products;





       /* $response['data'] = $products;
        $response['message'] = "This is all products";
        return  response()->json($response,200);*/
    }
     public function asc()
    {
        $products=Product::orderBy('name', 'asc')->get();
        foreach ($products as $product) {
            $b_date=Carbon::today();
            $f_date=Carbon::parse($product->exp_date);
             if($f_date->Ispast())
            {
                $product-> delete();
            }
            if($b_date->diffInDays($f_date)<=$product->pe3)
            {
                $product->price=$product->price-($product->price*$product->discount_pe3/100);
            }
            elseif($b_date->diffInDays($f_date)<=$product->pe2)
            {
                $product->price=$product->price-($product->price*$product->discount_pe2/100);
            }
            elseif($b_date->diffInDays($f_date)<=$product->pe1)
            {
                $product->price=$product->price-($product->price*$product->discount_pe1/100);
            }
        }
        return $products;





       /* $response['data'] = $products;
        $response['message'] = "This is all products";
        return  response()->json($response,200);*/
    }
     public function desc()
    {
        $products=Product::orderBy('name', 'desc')->get();
        foreach ($products as $product) {
            $b_date=Carbon::today();
            $f_date=Carbon::parse($product->exp_date);
             if($f_date->Ispast())
            {
                $product-> delete();
            }
            if($b_date->diffInDays($f_date)<=$product->pe3)
            {
                $product->price=$product->price-($product->price*$product->discount_pe3/100);
            }
            elseif($b_date->diffInDays($f_date)<=$product->pe2)
            {
                $product->price=$product->price-($product->price*$product->discount_pe2/100);
            }
            elseif($b_date->diffInDays($f_date)<=$product->pe1)
            {
                $product->price=$product->price-($product->price*$product->discount_pe1/100);
            }
        }
        return $products;





      /*  $response['data'] = $products;
        $response['message'] = "This is all products";
        return  response()->json($response,200);*/
    }
    

    public function show($id)
    {
        $product = Product::find($id);
        if (isset($product)) {
            $product->view_count = $product->view_count+1;
            $product->save();
            $b_date=Carbon::today();
            $f_date=Carbon::parse($product->exp_date);
            if($f_date->Ispast())
            {
                $product-> delete();
            }
            if($b_date->diffInDays($f_date)<=$product->pe3)
            {
                $product->price=$product->price-($product->price*$product->discount_pe3/100);
            }
            elseif($b_date->diffInDays($f_date)<$product->pe2)
            {
                $product->price=$product->price-($product->price*$product->discount_pe2/100);
            }
            elseif($b_date->diffInDays($f_date)<$product->pe1)
            {
                $product->price=$product->price-($product->price*$product->discount_pe1/100);
            }

           return $product;


        }
        $response['data'] = $product;
        $response['message'] = "Error Not Found";
        return  response()->json($response,404);

    }
    public function store(Request $request ){
    
        $product = new Product();
        $product->name=$request->name;
        $product->description=$request->description;
        $product->exp_date=$request->exp_date;
        $product->contact_info=$request->contact_info;
        $product->quantity=$request->quantity;
        $product->price=$request->price;
        $product->pe1=$request->pe1;
        $product->pe2=$request->pe2;
        $product->pe3=$request->pe3;
        $product->discount_pe1=$request->discount_pe1;
        $product->discount_pe2=$request->discount_pe2;
        $product->discount_pe3=$request->discount_pe3;
        $product->view_count=$request->view_count;
        $product->category_id=$request->category_id;
        $product->user_id=Auth::user()->id;
        $image = $request->file('image');
        $name = time().'.'.$image->getClientOriginalExtension();
        $destinationpath = public_path('/upload');
        $image->move($destinationpath , $name);
        $product->image = $name;


        $product->save();
       return $product;
    }

    public function update(Request $request , $id){

     $product = product::where('id' , $id)->first();
      // if($product->user_id == auth()->id()) {
         if (isset($product)) {
            if (isset($request->name)) {
                $product->name = $request->name;
            }

            if (isset($request->description)) {
                $product->description = $request->description;
            }

            if (isset($request->contact_info)) {
                $product->contact_info = $request->contact_info;
            }
            if (isset($request->quantity)) {
                $product->quantity = $request->quantity;
            }
            if (isset($request->price)) {
                $product->price = $request->price;
            }
            if (isset($request->pe1)) {
                $product->pe1 = $request->pe1;
            }
            if (isset($request->pe2)) {
                $product->pe2 = $request->pe2;
            }
            if (isset($request->pe3)) {
                $product->pe3 = $request->pe3;
            }
            if (isset($request->discount_pe1)) {
                $product->discount_pe1 = $request->discount_pe1;
            }
            if (isset($request->discount_pe2)) {
                $product->discount_pe2 = $request->discount_pe2;
            }
            if (isset($request->discount_pe3)) {
                $product->discount_pe3 = $request->discount_pe3;
            }
            if (isset($request->image)) 
            { 
               $image = $request->file('image');
               $name = time().'.'.$image->getClientOriginalExtension();
               $destinationpath = public_path('/upload');
               $image->move($destinationpath , $name);
               $product->image = $name;
           }

           $product->save();
           return $product;

       }

       $response['data'] = $product;
       $response['message'] = "Error Not Found";
       return response()->json($response,404);

   }



public function destroy($id)
{
    $product = Product::find($id);
    if (isset($product)) {
        $product->delete();
       
        $response['message'] = "Product Deleted Successfully";
        return  response()->json($response,200);

    }
   
    $response['message'] = "Error Not Found";
    return  response()->json($response,404);

}

public function Search(Request $request) {
   
  
   
    if ($request->name && $request->date) {
      $search_product = Product::where('name', 'like', "%{$request->name}%")
    ->where('exp_date', 'like', "{$request->date}")
    ->get();
     return $search_product;
     
   }
     elseif ($request->name){
         $search_product = Product::where('name', 'like', "%{$request->name}%")->get();
         return  $search_product;
     
   }
    elseif ($request->date){
         $search_product = Product::where('exp_date', 'like', "{$request->date}")->get();
         return  $search_product;
     
   }
   else
   {
    return response()->json(['Result' => ' Data not found'], 404);
}

}


}
