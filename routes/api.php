<?php

use Illuminate\Http\Request;
use App\Product;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
  return $request->user();
});


//  CategoriesController CategoriesController Api

Route::get('categories','CategoriesController@index');
Route::get('categories/{id}','CategoriesController@show');
Route::post('categories/store','CategoriesController@store');
Route::post('categories/update/{id}','CategoriesController@update');
Route::post('categories/delete/{id}','CategoriesController@destroy');
Route::get('searchc/','CategoriesController@SearchByCategory');

   //  productsController productsController Api

Route::get('products','ProductsController@index');
Route::get('products/asc','ProductsController@asc');
Route::get('products/desc','ProductsController@desc');
Route::get('products/{id}','ProductsController@show');
Route::middleware('auth:api')->post('products/store','ProductsController@store');
Route::post('products/update/{id}','ProductsController@update');
Route::post('products/delete/{id}','ProductsController@destroy');
Route::get('search/','ProductsController@search');


//registerController registerController Api
Route::post('register','RegisterController@register');
Route::post('login','LoginController@login');
Route::middleware('auth:api')->post('logout','LoginController@logout');

//  CommentsController CommentsController Api

Route::get('comments','CommentsController@index');
Route::middleware('auth:api')->post('comments/store','CommentsController@store');
Route::post('comments/update/{id}','CommentsController@update');
Route::post('comments/delete/{id}','CommentsController@destroy');

//  LikesController LikesController Api

Route::middleware('auth:api')->post('like/{id}','LikesController@index');
