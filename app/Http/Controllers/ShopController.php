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
    public function __construct() {

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
     * 詳細画面の表示
     *
     * @param  int  $id
     * @return View
     */
    public function showDetail($id)
    {
        $shop = Shop::find($id);
        $products = $shop->products;
        if (is_null($shop)) {
            \Session::flash('err_msg', 'データがありません。');
            return redirect(route('shops'));
        }
        return view(
            'shop.detail',
            compact('shop','products')
        );
    }

    // public function showList(Request $request)
    // {
    //     $user_id = Auth::id(); //ログインユーザーのID取得
    //     $user_shop = Shop::with('user')->where('user_id', '=', $user_id)->simplePaginate(8); //ログインユーザーのIDに紐ついた在庫のみ取得
    //     return view('Shops.index', ['deta' => $deta]); // views/stock/list.blade.phpに取得データを渡す
    // }
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
            'name' => 'required|max:32|unique:shops',
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

    // public function exeCreate(Request $request, $shop_id) {
    //     dd($request->all());
    //     $shop = Shop::find($shop_id);

    //     $this->validate($request, [
    //         'name' => 'required|max:32|space|unique:shops,name,' . $shop->id . ',id',
    //         'description' => 'required|max:255|space'
    //     ]);

      
    //     $shop->user_id = Auth::id();
    //     $shop->name = $request->input('name');
    //     $shop->description = $request->input('description');

    //     $shop->save();

    //     return redirect()->action('ShopController@showDetail', ['shop_id' => $shop->id]);
    // }
    
}
