<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Shop;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller


{
    /**
     * 一覧画面の表示
     *
     * 
     * @return View
     */
    public function showList()
    {
        $products = Product::all();

        return view(
            'products.list',
            ['products' => $products]
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
        $product = Product::find($id);
        if (is_null($product)) {
            \Session::flash('err_msg', 'データがありません。');
            return redirect(route('products'));
        }
        return view(
            'products.detail',
            compact('product')
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
            'products.form',
        );
    }

    /**
     * 商品登録
     *
     * 
     * @return View
     */
    public function exeRegister(Request $request)
    {
        dd($request->all());
        Product::create();
        \Session::flash('err_msg', '商品を登録しました。');
        return redirect(route('products'));;
    }
    /*
     *CSV出力 
     */
    public function postCSV()
    {
        //
    }
}
