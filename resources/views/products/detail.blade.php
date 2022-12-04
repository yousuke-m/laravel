@extends('layouts.app')
@section('title', '商品一覧')

@section('content')

    <div class="row">
        <div class="col-md-10 col-md-offset-2">
            @isset($product->id)
                @if (session('flash-message'))
                    <div class="flash-message">
                        <p class="buy">{{ session('flash-message') }}</p>
                    </div>
                @endif
                <h2>{{ $product->name }}</h2>
                <p class="description">商品説明:{!! nl2br(e($product->description)) !!}</p>
                <p>価格: {{ $product->price }}円</p>
                {{-- @if ($user_id == $shop->user_id) --}}
                @if ($product->stock >= 10)
                    <p>在庫: ◎</p>
                @elseif ($product->stock >= 1)
                    <p>在庫: △</p>
                @else
                    <p>在庫: <span class="sold-out">sold out</span></p>
                @endif

                @if ($user_id == $shop->user_id)
                    <div class="admin-button">
                        <a href="{{ route('product.edit', ['shop_id' => $shop->id, 'id' => $product->id]) }}"
                            class="btn blue-button edit">商品を編集</a>
                        <form action="{{ route('product.destroy', ['shop_id' => $shop->id, 'id' => $product->id]) }}"
                            method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" onclick="return confirm('本当に削除しますか？')"
                                class="btn danger-button delete">この商品を削除</button>
                        </form>
                    </div>
                @else
                    <div class="buy-button">
                        <form action="{{ route('product.buy', ['shop_id' => $shop->id, 'id' => $product->id]) }}"
                            method="post">
                            @csrf
                            @if ($product->stock <= 0)
                                <button class="btn" disabled>購入できません</button>
                            @else
                                <button type="submit" class="btn orange-button">購入</button>
                            @endif
                        </form>
                    </div>
                @endif
                <a href="{{ route('shop', ['shop_id' => $shop->id]) }}" class="btn blue-button">ショップに戻る</a>
            @endisset
        </div>
    </div>
@endsection