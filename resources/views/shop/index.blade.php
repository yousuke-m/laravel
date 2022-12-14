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
        <h2>ショップ一覧</h2>
        @if (session('err_msg'))
            <p class="text-danger">
                {{ session('err_msg') }}
            </p>
        @endif
        <table class="table table-striped">
            <tr>
                <th>番号</th>
                <th>ショップ</th>
                <th>日付</th>
            </tr>
            @foreach($shops as $shop)
            <tr>
                <td>{{ $shop->id  }}</td>
                <td><a href="/shop/{{ $shop->id }}">{{ $shop->name  }}</a></td>
                <td>{{ $shop->updated_at  }}</td>
            </tr>
            @endforeach
        </table>
        <a class="button" href="{{ route('make') }}">新しいショップを開設する</a>
    </div>
</div>
@endsection