@extends('layouts.app')
@section('title', '商品一覧')
@section('content')
    <div class="row">
        <div class="col-md-10 col-md-offset-2">
            <h1>{{ $shop->name }}</h1>
            <span>更新日:{{ $shop->updated_at }}</span>
            <p>{{ $shop->description }} </p>
            @foreach ($products as $product)
                <div class="wrapper grid">
                    <div class="item">
                        <img src="" alt="">
                        <p>{{ $product->id }}</p>
                        <a href="/products/{{ $product->id }}">{{ $product->id }}{{ $product->name }}</a>
                    </div>
                </div>
            @endforeach
            <div class="mt-5">
                <a class="btn btn-primary" href="{{ route('create') }}" role="button">出品する</a>


            @endsection
