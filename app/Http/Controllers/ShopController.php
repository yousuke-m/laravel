<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{
    public function __construct()
    {

        $this->middleware('auth');
    }

    // @return view
    public function showList()
    {
        $shops = Shop::all();
        return view(
            'shop.index',
            ['shops' => $shops]
        );
    }

        /**
     * 登録画面の表示
     *
     * 
     * @return View
     */
    public function showCreate()
    {
        return view(
            'shop.form',
        );
    }

    /**
     * 商品登録
     *
     * 
     * 
     */
    public function exeCreate(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:32',
            'description' => 'required|max:255'
        ]);
        $shop = new Shop([
            'user_id' => Auth::id(),
            'name' => $request->input('name'),
            'description' => $request->input('description'),
        ]);
        $shop->save();
        \Session::flash('err_msg', 'ショップを登録しました。');
        return redirect(route('shops'));;
    }
    /**
     * 詳細画面の表示
     *
     * @param  int  $id
     * @return View
     */
    public function showDetail($shop_id)
    {
        $shop = Shop::find($shop_id);
        $user_id = Auth::id();
        $products = $shop->products;
        if (is_null($shop)) {
            \Session::flash('err_msg', 'データがありません。');
            return redirect(route('shops'));
        }
        return view(
            'shop.detail',
            compact('shop', 'products','user_id')
        );
    }


    // ショップ編集画面

    public function edit($shop_id)
    {
        $shop = Shop::find($shop_id);
        if ($shop->user_id == Auth::id()) {
            return view('shop.edit', compact('shop'));
        }

        return abort(403);
    }

    // ショップ編集処理

    public function update(Request $request, $shop_id)
    {
        $shop = Shop::find($shop_id);

        $this->validate($request, [
            'name' => 'required|max:32',
            'description' => 'required|max:255'
        ]);


        $shop->user_id = Auth::id();
        $shop->name = $request->input('name');
        $shop->description = $request->input('description');

        $shop->save();

        return redirect()->action('ShopController@showDetail', ['shop_id' => $shop->id]);
    }

    // 削除機能

    public function destroy($shop_id) {
        $shop = Shop::find($shop_id);
        $shop->delete();
        \Session::flash('err_msg', 'ショップを削除しました。');
        return redirect(route('shops'));
    }
}
