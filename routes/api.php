<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/* |-------------------------------------------------------------------------- | API Routes |-------------------------------------------------------------------------- | | Here is where you can register API routes for your application. These | routes are loaded by the RouteServiceProvider within a group which | is assigned the "api" middleware group. Enjoy building your API! | */

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get("v1/posts", 'Api\PostController@index');
Route::get("v1/posts/random", 'Api\PostController@inRandomOrder');
Route::get("v1/posts/filter", 'Api\PostController@filter');

Route::get("v1/tags", 'Api\TagController@index');

Route::get("v1/categories", 'Api\CategoryController@index');
Route::get("v1/categories/{id}", 'Api\CategoryController@show');

Route::get("v1/posts/{id}", 'Api\PostController@show');

Route::post('v1/contacts', 'Api\ContactController@sendMessage')->middleware('api.auth');