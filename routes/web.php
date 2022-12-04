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
// ユーザー画面
Route::get('/profile','UserController@showMypage')->name('mypage');

// ショップ一覧を表示

Route::get('/shop', 'ShopController@showlist')->name('shops');
// 商品登録画面を表示
Route::get('/shop/create', 'ShopController@showCreate')->name('make');
// 商品登録画面
Route::post('/shop/create', 'ShopController@exeCreate')->name('registration');
// ショップ詳細を表示
Route::get('/shop/{shop_id}', 'ShopController@showDetail')->name('shop');
Route::get('/shop/{shop_id}/edit', 'ShopController@edit')->name('edit');
Route::put('/shop/{shop_id}/edit', 'ShopController@update')->name('update');

Route::delete('shop/{shop_id}', 'ShopController@destroy')->name('destroy');
Route::post('/shop/{shop_id}', 'ProductController@shopCSV')->name('productsCSV');


Route::group(['prefix' => 'shop/{shop_id}/product', 'as' => 'product.'], function() {
// 商品登録画面
Route::get('create', 'ProductController@showCreate')->name('create');
Route::post('create', 'ProductController@exeRegister')->name('register');
// 商品詳細を表示
Route::get('{id}', 'ProductController@showDetail')->name('show');
// 商品購入
Route::post('{id}', 'ProductController@buyProduct')->name('buy');

// 削除機能
Route::delete('{id}', 'ProductController@destroy')->name('destroy');
// 編集画面
Route::get('{id}/edit', 'ProductController@edit')->name('edit');
Route::put('{id}/edit', 'ProductController@update')->name('update');


});
