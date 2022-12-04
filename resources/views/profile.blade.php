@extends('layouts.app')

@section('title', 'マイページ')

@section('content')
    <div class="row">
        <div class="col-md-10 col-md-offset-2">
            <div class="body-container">
                <h1>{{ Auth::user()->name }}さんのマイページ</h1>
<br>
                <div class="shops-container">
                    <h3>マイショップ</h3>
                    <div class="shops">
                        @foreach ($myShops as $myShop)
                            <div class="shop">
                                <a href="{{ route('shop', ['shop_id' => $myShop->id]) }}">{{ $myShop->name }}</a>
                            </div>
                        @endforeach
                    </div>
                </div>
                <br>
                <div class="admin-button">
                    <button type="subu" href="{{ route('make') }}" class="btn btn-outline-info">ショップ作成</button>
                    <div>
                        <button type="button" class="btn btn-outline-danger" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                         document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </button>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection
