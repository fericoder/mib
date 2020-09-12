<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('/{token}/generate/', 'ApiController@generate');
Route::get('/{token}/inventory/{id}/{amount}/', 'ApiController@inventory');
Route::get('/{token}/purchases/{from}/{to}/', 'ApiController@purchases');
Route::get('/{token}/userPurchases/{user_id}/', 'ApiController@purchases');
Route::get('/{token}/amountReport/', 'ApiController@amountReport');

