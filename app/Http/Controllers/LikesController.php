<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Like;
use App\User;
use App\Product;
use Illuminate\Support\Facades\Auth;


class LikesController extends Controller
{
    public function index($id)
   {
        $user_like = Like::where('product_id' , $id)->where('user_id' , auth()->user()->id)->first();
        if (!$user_like)
        {
            $user_like = new Like();
            $user_like->product_id=$id;
            $user_like->user_id=auth()->user()->id;
            $user_like->save();
            $product = Product::find($id);
            $product->like_count ++;
            $product->save();
            return response()->json(['massage'=> 'like added'],200);
        }
        else
        {             
             $user_like-> delete();
             $product = Product::find($id);
             $product->like_count --;
             $product->save();
            return response()->json(['massage'=> 'deleted'],400);
        }
   }
}
