<?php

use Illuminate\Http\Request;

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

Route::get('/business', 'BusinessController@getBusiness');
Route::get('/business/category/{slug}', 'BusinessController@getBusinessByCategory');
Route::get('/business/search', 'BusinessController@searchBusiness');

Route::middleware('auth:api')->delete('/products', 'ProductsController@destroy');
Route::middleware('auth:api')->put('/products', 'ProductsController@edit');


// Get Data
Route::get('/categories', 'Api\CategoriesController@index');
Route::get('/plans', 'Api\PlansController@index');
