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

// Route::get('/', function() {
//     return view('guest.home');
// })->name('guest.home');


// Route::get('/posts', 'Guest\PostController@index')->name('guest.posts.index');
// Route::get('/posts/{post}', 'Guest\PostController@show')->name('guest.posts.show');

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
        // CATEGORIES
        Route::resource('categories', 'CategoryController');
        // TAGS
        Route::resource('tags', 'TagController');
        // PHOTOS
        Route::resource('photos', 'PhotoController');
    });


Route::get("{any?}", function () {
  return view("guest.home");
})->where("any", ".*")->name('default');
