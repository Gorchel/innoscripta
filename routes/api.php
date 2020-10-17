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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});



Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {
    Route::post('register', 'AuthController@register');
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
});

Route::group([

    'middleware' => 'api',
    'prefix' => 'order'

], function ($router) {
    Route::post('checkout', 'OrderController@checkout');
    Route::post('orderHistory', 'HistoryOrderController@orderHistory');
});

Route::get('/currency/list', '\App\Http\Controllers\Api\CurrencyController@getList');
Route::get('/good/list/{type}', '\App\Http\Controllers\Api\GoodController@getList');
