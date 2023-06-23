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

Route::middleware('auth:api')->group(function () {
    Route::apiResource('product', 'App\Http\Controllers\Api\ProductController')->only(['destroy']);
    Route::post('product/store', 'App\Http\Controllers\Api\ProductController@store');
    Route::post('product/update/{id}', 'App\Http\Controllers\Api\ProductController@update');
});

Route::apiResource('product', 'App\Http\Controllers\Api\ProductController')->only(['show', 'index']);
