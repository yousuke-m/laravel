<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

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
dd($id);
        // if (is_null($product)) {
        //     \session::flash('err_msg', 'データがありません。');
        //     return redirect(route('products'));
        // }
        // return view(
        //     'products.detail',
        //  compact('product')
        // );
    }
}
