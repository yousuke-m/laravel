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
// トップ画面を表示
Route::get('/', 'HomeController@showTop')->name('top');
// ログイン画面を表示
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

// ショップ一覧を表示
Route::get('/shop', 'ShopController@showlist')->name('shops');
// ショップ詳細を表示
Route::get('/shop/{id}', 'ShopController@showDetail')->name('shop');
// 商品登録画面を表示
Route::get('/shops/create', 'ShopController@showCreate')->name('make');
// 商品登録画面
Route::post('/shops/create', 'ShopController@exeCreate')->name('registration');
Route::post('/shops/{shop_id}', 'ProductController@shopCSV')->name('productsCSV');

// 商品一覧を表示
Route::get('/product', 'ProductController@showList')->name('products');
// 商品登録画面を表示
Route::get('/product/create', 'ProductController@showCreate')->name('create');
// 商品登録画面
Route::post('/product/create', 'ProductController@exeRegister')->name('register_pro');
// 商品詳細を表示
Route::get('/products/{id}', 'ProductController@showDetail')->name('show');



