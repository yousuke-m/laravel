@extends('layouts.app')
@section('title', '商品一覧')
@section('content')
    <!--
        ①route作成（削除ボタン）
        ②Controllerづくり
        ③削除機能づくり
         -->
        
    <div class="row">
        <div class="col-md-10 col-md-offset-2">
            <h2>{{ $product->name }}</h2>
            <span>更新日:{{ $product->updated_at }}</span>
            <p>{{ $product->description }} </p>
            <p>価格:{{ $product->price }}</p>
            <p>在庫:{{ $product->stock }}</p>
        @endsection
