<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Shop;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller



    {
        public function __construct() {
    
            $this->middleware('auth');
    
        }
    /**
     * 一覧画面の表示
     *
     * 
     * @return View
     */


    /**
     * 詳細画面の表示
     *
     * @param  int  $id
     * @return View
     */
    public function showDetail($shop_id, $id)
    {
        $product = Product::find($id);
        $shop = Shop::find($shop_id);
        $user_id = Auth::id();
        if (is_null($product)) {
            \Session::flash('err_msg', 'データがありません。');
        }
        return view(
            'products.detail',
            compact('product', 'shop', 'user_id')
        );
    }

    // 商品購入
    public function buyProduct($shop_id, $id)
    {
        $product = Product::find($id);
        $shop = Shop::find($shop_id);
        $product->decrement('stock');

        return redirect()->action('ProductController@showDetail', ['shop_id' => $shop->id, 'id' => $product->id])->with('flash-message', '購入が完了しました！');
    }
    /**
     * 登録画面の表示
     *
     * 
     * @return View
     */
    public function showCreate($shop_id)
    {
        $shop = shop::find($shop_id);

        if ($shop->user_id == Auth::id()) {
            return view('products.form', compact('shop'));
        }
        return abort(403);
    }

    // /**
    //  * 商品登録
    //  *
    //  * 
    //  * @return View
    //  */

    public function exeRegister(Request $request, $shop_id)
    {
        $this->validate($request, [
            'name' => 'required|max:32',
            'description' => 'required|max:255',
            'price' => 'required|integer|between:1,100000',
            'stock' => 'required|integer|between:1,1000'
        ]);

        $shop = Shop::find($shop_id);
        $product = new Product([
            'shop_id' => $shop->id,
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'stock' => $request->input('stock')
        ]);

        $product->save();
        \Session::flash('err_msg', '商品を登録しました。');
        return redirect()->route('shop', $shop_id);
    }

    /*
     *削除機能 
     */
    public function destroy($shop_id, $id)
    {
        $product = Product::find($id);
        $product->delete();
        \Session::flash('err_msg', '商品を削除しました');
        return redirect()->route('shop', $shop_id);
    }
/*
     *編集画面
     */
    public function edit($shop_id, $id) {
        $shop = Shop::find($shop_id);
        $product = Product::find($id);
        if ($shop->user_id == Auth::id()) {
            return view('products.edit', compact('product', 'shop'));
        }

        return abort(403);
    }
    public function update(Request $request, $shop_id, $id) {
        $product = Product::find($id);
        $shop = Shop::find($shop_id);

        $this->validate($request, [
            'productName' => 'required|max:32',
            'productDescription' => 'required|max:255',
            'price' => 'required|integer|between:1,100000',
            'stock' => 'required|integer|between:1,1000'
        ]);
        $product->shop_id = $shop->id;
        $product->name = $request->input('productName');
        $product->description = $request->input('productDescription');
        $product->price = $request->input('price');
        $product->stock = $request->input('stock');

        $product->save();
        \Session::flash('err_msg', '商品を変更しました');
        return redirect()->route('product.show',['shop_id'=>$shop->id,'id'=>$product->id]);
    
    }
    /*
     *CSV出力 
     */
    // コントローラーの1メソッドとして実装
    // public function shopCSV($shop_id)
    // {
    //     $shop = Shop::find($shop_id);
    //     $products = Product::where('shop_id', $shop_id)->get();
    //     // 出力バッファをopen
    //     $stream = fopen('php://output', 'w');
    //     // 文字コードをShift-JISに変換
    //     stream_filter_prepend($stream, 'convert.iconv.utf-8/cp932//TRANSLIT');
    //     // ヘッダー行
    //     fputcsv($stream, [
    //         'ID',
    //         'ショップID',
    //         '商品名',
    //         '商品説明',
    //         '価格',
    //         '在庫',
    //         '登録日時',
    //         '更新日時'
    //     ]);
    //     // CSV出力
    //     foreach ($products as $product) {
    //         $arrInfo = [
    //             'ID' => $product->id,
    //             'ショップID' => $product->shop_id,
    //             '商品名' => $product->name,
    //             '商品説明' => $product->description,
    //             '価格' => $product->price,
    //             '在庫' => $product->stock,
    //             '登録日時' => $product->created_at,
    //             '更新日時' => $product->updated_at
    //         ];
    //         // データ
    //         $products = Product::orderBy('id', 'desc');
    //         // ２行目以降の出力
    //         // cursor()メソッドで１レコードずつストリームに流す処理を実現できる。
    //         fputcsv($stream, $arrInfo);
    //     }

    //     rewind($stream);

    //     $csv = stream_get_contents($stream);
    //     $csv = mb_convert_encoding($csv, 'sjis-win', 'UTF-8');

    //     fclose($stream);
        
    //     $headers = [
    //         'Content-Type' => 'text/csv',
    //         'Content-Disposition' => 'attachment; filename=shopProducts.csv'
    //     ];


    //     return response()->make($csv, 200, $headers);
    // }

    public function shopCSV($shop_id) {
        $shop = Shop::find($shop_id);
        $shop_id = $shop->id;
        $products = Product::where('shop_id', $shop_id)->get();

        $stream = fopen('php://temp', 'w');

        $column = [
            'ID',
            'ショップID',
            '商品名',
            '商品説明',
            '価格',
            '在庫',
            '登録日時',
            '更新日時'
        ];

        fputcsv($stream, $column);

            
        foreach ($products as $product) {
            $arrInfo = [
                'ID' => $product->id, 
                'ショップID' => $product->shop_id,
                '商品名' => $product->name,
                '商品説明' => $product->description,
                '価格' => $product->price,
                '在庫' => $product->stock,
                '登録日時' => $product->created_at,
                '更新日時' => $product->updated_at
            ];

            fputcsv($stream, $arrInfo);
        }

        rewind($stream);

        $csv = stream_get_contents($stream);
        $csv = mb_convert_encoding($csv, 'sjis-win', 'UTF-8');

        fclose($stream);
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename=shopProducts.csv'
        ];


        return response()->make($csv, 200, $headers);
    }

}
