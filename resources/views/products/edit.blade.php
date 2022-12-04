@extends('layouts.app')
@section('title', '商品一覧')
@section('content')
    <div class="row">
        <div class="col-md-10 col-md-offset-2">
            <form action="{{ route('product.edit', ['shop_id' => $product->shop_id, 'id' => $product->id]) }}" method="post"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form">
                    <p class="item-header">商品名 (32文字以内)<span class="required-icon">必須</span></p>
                    <input class="input-field" type="text" name="productName"
                        value="{{ old('productName') ?: $product->name }}">
                    @error('productName')
                        <li class="error">{{ $message }}</li>
                    @enderror
                    <p class="item-header">商品詳細 (255文字以内)<span class="required-icon">必須</span></p>
                    <textarea class="input-area" type="text" name="productDescription">{{ old('productDescription') ?: $product->description }}</textarea>
                    @error('productDescription')
                        <li class="error">{{ $message }}</li>
                    @enderror
                    <p class="item-header">価格<span class="required-icon">必須</span></p>
                    <div class="unit-form">
                        <input class="input-field add-unit" type="text" name="price"
                            value="{{ old('price') ?: $product->price }}"><span>円</span>
                    </div>
                    @error('price')
                        <li class="error">{{ $message }}</li>
                    @enderror
                    <p class="item-header">在庫<span class="required-icon">必須</span></p>
                    <div class="unit-form">
                        <input class="input-field add-unit" type="text" name="stock"
                            value="{{ old('stock') ?: $product->stock }}"><span>個</span>
                    </div>
                    @error('stock')
                        <li class="error">{{ $message }}</li>
                    @enderror
                    <div class="submit-button">
                        <a href="{{ route('shop', ['shop_id' => $shop->id]) }}"
                            class="btn blue-button back">戻る</a>
                        <input class="button" type="submit" value="更新">
                    </div>
                </div>
            </form>
            <script>
                function checkSubmit() {
                    if (window.confirm('送信してよろしいですか？')) {
                        return true;
                    } else {
                        return false;
                    }
                }
            </script>
        </div>
    </div>
@endsection
