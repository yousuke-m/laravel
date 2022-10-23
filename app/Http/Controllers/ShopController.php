<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{
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
     * 詳細画面の表示
     *
     * @param  int  $id
     * @return View
     */
    public function showDetail($id)
    {
        $shop = Shop::find($id);
        if (is_null($shop)) {
            \Session::flash('err_msg', 'データがありません。');
            return redirect(route('shops'));
        }
        return view(
            'shop.detail',
            compact('shop')
        );
        // public function showList(Request $request)
    // {
    //     $user_id = Auth::id(); //ログインユーザーのID取得
    //     $user_shop = Shop::with('user')->where('user_id', '=', $user_id)->simplePaginate(8); //ログインユーザーのIDに紐ついた在庫のみ取得
    //     return view('Shops.index', ['deta' => $deta]); // views/stock/list.blade.phpに取得データを渡す
    // }
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
     * @return View
     */
    public function exeCreate(Request $request)
    {
        dd($request->all());
        Shop::create();
        \Session::flash('err_msg', 'ショップを登録しました。');
        return redirect(route('shops'));;
    }

    
}
