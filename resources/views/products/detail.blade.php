@extends('layouts.app')
@section('title', '商品一覧')
@section('content')

    <div class="row">
        <div class="col-md-10 col-md-offset-2">
            <h1>{{ $product->name }}</h1>
            <span>更新日:{{ $product->updated_at }}</span>
            <p>{{ $product->description }} </p>
            <p>価格:{{ $product->price }}</p>
            <p>在庫:{{ $product->stock }}</p>
            <form action="{{ route('productsCSV', ['shop_id' => $shop->id]) }}" method="post">
                @csrf
                <button type="submit" class="btn blue-button csv">ショップ商品のCSV出力</button>
              </form>
            <button class="button">
                購入する
            </button>
        @endsection
