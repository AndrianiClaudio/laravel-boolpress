<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function() {
    return view('guest.home');
})->name('guest.index');

Auth::routes();

Route::middleware('auth')
    ->namespace('Admin')
    ->name('admin.')
    ->prefix('admin')
    ->group(function () {
        // HOME
        Route::get('/',
            'HomeController@index')
            ->name('home');
        // POSTS
        Route::resource('posts', 'PostController');
        // USER INFO
        Route::resource('user_infos', 'UserInfoController');
    });