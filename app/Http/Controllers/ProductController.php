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
        $shop = $product->shop;
        if (is_null($product)) {
            \Session::flash('err_msg', 'データがありません。');
            return redirect(route('products'));
        }
        return view(
            'products.detail',
            compact('product', 'shop')
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

    public function exeRegister(Request $request,$shop_id)
    {
        dd($shop_id);
        $this->validate($request, [
            'name' => 'required|max:32',
            'description' => 'required|max:255',
            'price' => 'required|integer|between:1,100000',
            'stock' => 'required|integer|between:1,1000'
        ]);

        $shop = Shop::find($shop_id);
        dd($shop);
        $product = new Product([
            'shop_id' => $shop->id,
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'stock' => $request->input('stock')
        ]);

        $product->save();
        \Session::flash('err_msg', '商品を登録しました。');
        // return redirect(route('products'), compact('shop'));;
        return redirect()->route('shop.detail', $shop_id);
    }
    /*
     *CSV出力 
     */
    // コントローラーの1メソッドとして実装
    public function shopCSV($shop_id)
    {
        $shop = Shop::find($shop_id);
        $shop_id = $shop->id;
        $products = Product::where('shop_id', $shop_id)->get();
        // 出力バッファをopen
        $stream = fopen('php://output', 'w');
        // 文字コードをShift-JISに変換
        stream_filter_prepend($stream, 'convert.iconv.utf-8/cp932//TRANSLIT');
        // ヘッダー行
        fputcsv($stream, [
            'ID',
            'ショップID',
            '商品名',
            '商品説明',
            '価格',
            '在庫',
            '登録日時',
            '更新日時'
        ]);
        // CSV出力
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
            // データ
            $products = Product::orderBy('id', 'desc');
            // ２行目以降の出力
            // cursor()メソッドで１レコードずつストリームに流す処理を実現できる。
            foreach ($products->cursor() as $product) {
                fputcsv($stream, [
                    $product->id,
                ]);
            }
            fclose($stream);
        };

        // 保存するファイル名
        $filename = sprintf('product-%s.txt', date('Ymd'));

        // ファイルダウンロードさせるために、ヘッダー出力を調整
        $header = [
            'Content-Type' => 'application/octet-stream',
        ];

        return response()->streamDownload($product, $filename, $header);
    }
}
