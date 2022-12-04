@extends('layouts.app')
@section('title', '商品一覧')

@section('content')
  <form aciton="{{ route('update', ['shop_id' => $shop->id]) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="form">
      <p class="item-header">ショップ名 (32文字以内)<span class="required-icon">必須</span></p>
      <input class="input-field" type="text" name="name" value="{{ old('name')?: $shop->name }}">
      @error('name')
        <li class="error">{{ $message }}</li>
      @enderror
      <p class="item-header">ショップ詳細 (255文字以内)<span class="required-icon">必須</span></p>
      <textarea class="input-area" type="text" name="description">{{ old('description')?: $shop->description }}</textarea>
      @error('description')
        <li class="error">{{ $message }}</li>
      @enderror
      <div class="submit-button">
        <a href="{{ route('shop', ['shop_id' => $shop->id]) }}"class="btn blue-button back">戻る</a>
        <input class="btn orange-button update" type="submit" value="更新">
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
  
@endsection