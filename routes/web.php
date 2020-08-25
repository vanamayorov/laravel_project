<?php

use Illuminate\Support\Facades\Auth;
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

Auth::routes([
    'confirm' => false,
    'reset' => false,
    'verify' => false
]);

Route::get('/logout', 'Auth\LoginController@logout')->name('get-logout');


Route::middleware(['auth'])->group(function () {
    Route::group([
        'prefix' => 'person',
        'namespace' => 'Person',
        'as' => 'person.'
    ], function () {
        Route::get('/orders', 'OrderController@index')->name('orders.index');
        Route::get('/orders/{order}', 'OrderController@show')->name('orders.show');
    });
    Route::group([
        'prefix' => 'admin',
        'middleware' => 'is_admin',
        'namespace' => 'Admin'
    ], function () {
        Route::get('/orders', 'OrderController@index')->name('home');
        Route::resource('/categories', 'CategoryController');
        Route::get('/orders/{order}', 'OrderController@show')->name('orders.show');

        Route::resource('products', 'ProductController');
    });
});





Route::get('/', 'MainController@index')->name('index');

Route::group(['prefix' => 'cart'], function () {
    Route::post('/add/{id}', 'CartController@productAdd')->name('productAdd');

    Route::group(['middleware' => 'basket_not_empty'], function () {

        Route::get('/', 'CartController@cart')->name('cart');

        Route::get('/place', 'CartController@cartPlace')->name('cartPlace');

        Route::post('/remove/{id}', 'CartController@productRemove')->name('productRemove');

        Route::post('/confirm', 'CartController@cartConfirm')->name('cartConfirm');
    });
});


Route::get('/categories', 'MainController@categories')->name('categories');

Route::get('/{category}', 'MainController@category')->name('category');

Route::get('/{category}/{product?}', 'MainController@product')->name('product');
