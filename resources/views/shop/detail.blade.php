@extends('layouts.app')
@section('title', 'ショップ詳細')
@section('content')
    <!--
                ①route作成（削除ボタン）
                ②Controllerづくり
                ③削除機能づくり
                 -->

    <div class="row">
        <div class="col-md-10 col-md-offset-2">
            <h1>{{ $shop->name }}</h1>
            <span>更新日:{{ $shop->updated_at }}</span>
            <p>{{ $shop->description }} </p>
            <button>
                <a class="btn btn-secondary" href="{{route('products')}}">このショップに移動する</a>
            </button>
            @foreach($products as $product)
            <tr>
                <td>{{ $product->id  }}</td>
                <td><a href="/products/{{ $product->id }}">{{ $product->name  }}</a></td>
                <td>{{ $product->updated_at  }}</td>
                <td><button type="button" class="btn btn-primary" onclick="location.href='/products/edit/{{ $product->id }}'">編集</button></td>
                {{-- <form method="POST" action="{{ route('delete', $product->id) }}" onSubmit="return checkDelete()"> --}}
                @csrf
                <td><button type="submit" class="btn btn-primary" onclick=>削除</button></td>
                </form>
            </tr>
            @endforeach
        </div>
    </div>
    
@endsection
