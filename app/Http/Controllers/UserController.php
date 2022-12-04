<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct()
    {

        $this->middleware('auth');
    }

    public function showMypage() {
        $user_id = Auth::id();
            $myShops = Shop::where('user_id', $user_id)->get();

            return view('profile', compact('myShops',));


    }

}
