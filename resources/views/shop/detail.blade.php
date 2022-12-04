@extends('layouts.app')
@section('title', '商品一覧')
@section('content')
    @isset($shop->id)
        <div class="row">
            <div class="col-md-10 col-md-offset-2">
                <h1>{{ $shop->name }}</h1>
                <span>更新日:{{ $shop->updated_at }}</span>
                <p>ショップ詳細:{{ $shop->description }} </p>
                @foreach ($products as $product)
                    <div class="wrapper grid">
                        <div class="item">
                            <br>
                            <a
                                href="{{ route('product.show', ['shop_id' => $shop->id, 'id' => $product->id]) }}">{{ $product->id }}{{ $product->name }}</a>
                        </div>
                    </div>
                @endforeach

                @if ($user_id == $shop->user_id)
                    <div class="admin-button">
                        <div class="mt-5">
                            <a class="btn btn-primary" href="{{ route('product.create',['shop_id' =>$shop->id]) }}" role="button">出品する</a>
            
                                    <div class="ud-button">
                            <a href="{{ route('edit', ['shop_id' => $shop->id]) }}" class="btn blue-button edit">ショップを編集</a>
                            <form action="{{ route('productsCSV', ['shop_id' => $shop->id]) }}" method="post">
                                @csrf
                                <button type="submit" class="btn blue-button csv">{{ $shop->name }}商品のCSV出力</button>
                            </form>
                            <form action="{{ route('destroy', $shop) }}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn danger-button delete"
                                    onclick="return confirm('本当に削除しますか？')">ショップを削除</button>
                            </form>
                        </div>
                    </div>
              
                    
                @endif


            @endsection
        @endisset
