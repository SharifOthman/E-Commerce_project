<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
class CategoriesController extends Controller
{
    public function index()
    {
     $categories = Category::all();
    
     return  $categories;
    }
    public function show($id)
    {
    $category = Category::find($id);
    if (isset($category)) {
      
       return $category;

    }
       $response['data'] = $category;
       $response['message'] = "Error Not Found";
       return  response()->json($response,404);
    
    }

    public function store(Request $request)
    {
        $category = new Category();
        $category->name = $request->name;
        $category->save();
       
        return  $category;
        
    }
    public function update(Request $request , $id)
    {
    $category = Category::where('id' , $id)->first();
    if (isset($category))
    {
        if (isset($request->name)){
        $category->name = $request->name;}
        $category->save();
     
       return  $category;

    }
       $response['data'] = '';
       $response['message'] = "Error Not Found";
       return  response()->json($response,404);

    }
    public function destroy($id)
    {
         $category = Category::find($id);
  if (isset($category)) {
        $category->delete();
        $response['data'] = '';
        $response['message'] = "Category Deleted Successfully";
       return  response()->json($response,200);

    }
       $response['data'] = '';
       $response['message'] = "Error Not Found";
       return  response()->json($response,404);
    
   
    
}

public function SearchByCategory(Request $request) {

    $data = $request->get('data');

    $search_category = Category::where('name', 'like', "%{$data}%")->get();
    if (count($search_category)){
     return response()->json([
        'data' => $search_category
    ]);     
 }
 else
 {
    return response()->json(['Result' => 'No Data not found'], 404);
}

}

}
