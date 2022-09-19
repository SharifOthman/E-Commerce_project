<?php

namespace App\Http\Middleware;

use Closure;
use App\Product;

class CheckUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($id , Closure $next  )
    {
        
       $product = product::where('id' , $id)->first();

        if ($product->user_id !== auth()->id()) {
            return'Unauthorized action.';

        }
        else{
             
        }
       
    }
}
