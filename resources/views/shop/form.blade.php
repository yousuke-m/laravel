@extends('layouts.app')
@section('title', '商品登録')
@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h1>ショップ登録</h1>
            <form method="POST" action="{{ Route('registration') }}" onSubmit="return checkSubmit()"></form>
            @csrf
            <div class="form-group">
                <label for="content">
                    ショップ名
                </label>
                <input id="title" name="title" class="form-control" value="{{ old('title') }}" type="text">
                @if ($errors->has('title'))
                    <div class="text-danger">
                        {{ $errors->first('title') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label for="content">
                    ショップ概要
                </label>
                <textarea id="content" name="content" class="form-control" rows="4">{{ old('content') }}</textarea>
                @if ($errors->has('content'))
                    <div class="text-danger">
                        {{ $errors->first('content') }}
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
                <button type="submit" class="btn btn-primary">
                    ショップを開設する
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
