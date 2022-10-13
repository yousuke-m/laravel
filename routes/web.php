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

// Route::get('/', function () {
//     return view('welcome');
// });
// ホーム画面を表示
Route::get('/', 'ProductController@showList')->name('products');
Route::get('/products/{$id}', 'ProductController@showDetail')->name('show');

// Route::get('/', 'ShopController@showList')->name('shops');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
