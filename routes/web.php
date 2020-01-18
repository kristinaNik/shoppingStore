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

Route::get('/', function () {
    return view('shop/index');
})->name('product.index');

Route::get('/search', 'ProductController@index')->name('search.action');

Route::get('/{id}', function(){
    return  view('shop/show');
})->name('product.show');

Route::get('/add-to-cart/{id}', 'ProductController@getAddToCart')->name('product.addToCart');

Route::get('/reduce/{id}', 'ProductController@getReduceByOne')->name('product.reduceByOne');

Route::get('/remove/{id}', 'ProductController@getRemoveItem')->name('product.remove');

Route::get('cart/shopping-cart', 'ProductController@getCart')->name('product.shoppingCart');
