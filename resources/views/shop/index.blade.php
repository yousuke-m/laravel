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
                <th></th>
                <th></th>
            </tr>
            @foreach($shops as $shop)
            <tr>
                <td>{{ $shop->id  }}</td>
                <td><a href="/shop/{{ $shop->id }}">{{ $shop->name  }}</a></td>
                <td>{{ $shop->updated_at  }}</td>
                {{-- <td><button type="button" class="btn btn-primary" onclick="location.href='/shop/edit/{{ $$shop->id }}'">編集</button></td> --}}
                {{-- <form method="POST" action="{{ route('delete', $product->id) }}" onSubmit="return checkDelete()"> --}}
                @csrf
                <td><button type="submit" class="btn btn-primary" onclick=>削除</button></td>
                </form>
            </tr>
            @endforeach
        </table>
        <a class="button" href="{{ route('make') }}">新しいショップを開設する</a>
    </div>
</div>
<script>
// function checkDelete(){
//     if(window.confirm('削除してよろしいですか？')){
//         return true;
//     } else {
//         return false;
//     }
// }
</script>
@endsection