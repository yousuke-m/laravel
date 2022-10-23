<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Shop extends Model
{
    // テーブル名
    protected $table = 'shops';
    // 可変項目
    protected $fillable = [
        'user_id',
        'name',
        'description'
    ];

    // ユーザとショップのリレーション

    public function User()
    {
        return $this->belongsTo('app\User');
        $contents_U = App\Models\Shops::find(1);
    }
    public function products() {
        return $this->hasMany('App\Models\Product');
        // $contents_p = App\Models\Product::find(1);
    }

}
