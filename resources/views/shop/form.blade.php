@extends('layouts.layout')
@section('title', '商品登録')
@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h1>ショップ登録</h1>
            <form method="POST" action="{{ Route('registration') }}" onSubmit="return checkSubmit()">
            @csrf
            <div class="form-group">
                <label for="content">
                    ショップ名
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
                    ショップ概要
                </label>
                <textarea id="description" name="description" class="form-control" rows="4">{{ old('description') }}</textarea>
                @if ($errors->has('description'))
                    <div class="text-danger">
                        {{ $errors->first('description') }}
                </div>
                <div class="form-group">
                    <label for="comtent">

                </div>
                @endif
            </div>
            <div class="mt-5">
                <a class="btn btn-secondary" href="{{ route('shops') }}">
                    キャンセル
                </a>
                <input class="btn btn-primary" type="submit" value="ショップを開設する">
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
