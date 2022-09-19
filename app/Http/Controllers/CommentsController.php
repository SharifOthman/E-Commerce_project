<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{
     public function index()
    {
     $comments = comment::all();
     $response['data'] = $comments;
     $response['message'] = "This is all comments";
     return  response()->json($response,200);
    }
   

    public function store(Request $request)
    {
        $comment = new comment();
        $comment->line = $request->line;
        $comment->user_id = Auth::user()->id;
        $comment->product_id = $request->product_id;
        $comment->save();
        $response['data'] = $comment;
        $response['message'] = "comment Created Successfully";
        return  response()->json($response,200);
        
    }
    public function update(Request $request , $id)
    {
    $comment = comment::where('id' , $id)->first();
    if (isset($comment))
    {
        if (isset($request->line)){
        $comment->line = $request->line;}
        $comment->save();
        $response['data'] = $comment;
        $response['message'] = "Update Successfully ";
       return  response()->json($response,200);

    }
       $response['data'] = '';
       $response['message'] = "Error Not Found";
       return  response()->json($response,404);

    }
    public function destroy($id)
    {
         $comment = comment::find($id);
  if (isset($comment)) {
        $comment->delete();
        $response['data'] = '';
        $response['message'] = "comment Deleted Successfully";
       return  response()->json($response,200);

    }
       $response['data'] = '';
       $response['message'] = "Error Not Found";
       return  response()->json($response,404);
    
   
    
}





}
