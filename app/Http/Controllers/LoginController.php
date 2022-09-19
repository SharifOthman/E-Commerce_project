<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    public function login(Request $request){
        if (auth()->attempt(['email'=>$request->input('email'),
            'password' => $request->input('password')])) {
           $user = auth()->user();
           $user->api_token = Str::random(60); 
           $user->save();
           return $user;

        }
       $response['message'] = "Email Or password in not correct";
          return  response()->json($response,404);


    }
    public function logout(){
        if (auth()->user()) {
            $user = auth()->user();
            $user->api_token= null;
            $user->save();
            return response()->json(['message' => 'thank you'],200);

      }

}
}