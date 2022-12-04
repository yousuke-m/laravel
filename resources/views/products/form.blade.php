@extends('layouts.app')
@section('title', '商品登録')
@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
          
            <h1>商品登録</h1>
            <form method="POST" action="{{ Route('product.register',['shop_id'=>$shop->id]) }}" onSubmit="return checkSubmit()">
                @csrf
                <div class="form-group">
                    <label for="content">
                        商品名
                    </label>
                    <input id="name" name="name" class="form-control" value="{{ old('name') }}" type="text">
                    @if ($errors->has('name'))
                        <div class="text-danger">
                            {{ $errors->first('name') }}
                        </div>
                    @endif
                </div>
                <div class="form-group">
                    <label for="content">
                        商品説明
                    </label>
                    <textarea id="description" name="description" class="form-control" rows="4">{{ old('description') }}</textarea>
                    @if ($errors->has('description'))
                        <div class="text-danger">
                            {{ $errors->first('description') }}
                        </div>
                    @endif
                </div>
                <label for="content">
                    商品価格
                </label>
                <div class="input-group mb-3">
                    <input id="price" name="price"value="{{ old('price') }}" type="text"class="form-control"
                        aria-label="Amount (to the nearest dollar)">
                    <span class="input-group-text">円</span>
                    @if ($errors->has('price'))
                        <div class="text-danger">
                            {{ $errors->first('price') }}
                        </div>
                    @endif
                </div>
                <label for="content">
                    商品在庫数
                </label>
                <div class="input-group mb-3">
                    <input id="stock" name="stock" class="form-control" value="{{ old('stock') }}" type="text">
                    <span class="input-group-text">個</span>
                    @if ($errors->has('stock'))
                        <div class="text-danger">
                            {{ $errors->first('stock') }}
                        </div>
                    @endif
                </div>
                <div class="mt-5">
                    <a class="btn btn-secondary" href="{{ route('shop',['shop_id'=>$shop->id,]) }}">
                        キャンセル
                    </a>
                    <button type="submit" class="btn btn-primary">
                        出品する
                    </button>
                </div>
            </form>
        </div>
    </div>
    <script>
        function checkSubmit() {
            if (window.confirm('送信してよろしいですか？')) {
                return true;
            } else {
                return false;
            }
        }
    </script>
@endsection
