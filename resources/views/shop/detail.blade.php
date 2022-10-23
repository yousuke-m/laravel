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
            
        </div>
    </div>
    
@endsection
