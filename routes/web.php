<?php

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


Auth::routes();

Route::get('/user', 'UserController@userProfile')->name('user.profile');
//Route::get('/', 'ProductController@index')->name('product.index');
Route::get('/', function () {
    return view('shop/index');
})->name('product.index');

Route::get('/add-to-cart/{id}', 'ProductController@getAddToCart')->name('product.addToCart');
Route::get('/reduce/{id}', 'ProductController@getReduceByOne')->name('product.reduceByOne');

Route::get('/shopping-cart', 'ProductController@getCart')->name('product.shoppingCart');
