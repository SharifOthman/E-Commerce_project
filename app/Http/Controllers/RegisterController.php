<?php

namespace App\Http\Controllers;
use App\user;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function register(Request $request){



        $validator = Validator::make($request->all(),[
            'name'=> 'required|max:191|string|unique:users',
            'email'=> 'required|max:191|string|unique:users|email',
            'password'=> 'required|max:191|string|string|min:8',
        ]);
        if($validator->fails()){
              return  response()->json($validator->errors(),404);
        }
        else {
          $user = User::create([
            'name'=>$request->name ,
            'email'=>$request->email ,
            'password'=>Hash::make($request->password),
            'api_token'=>Str::random(60)
        ]);
          $response['data'] = $user;
          $response['message'] = "User Created Successfully";
          return  response()->json($response,200);
      }



  }
}
