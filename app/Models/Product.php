<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // テーブル名
    protected $table = 'products';
    // 可変項目
    protected $fillable = [
        'shop_id',
        'name',
        'description',
        'price',
        'stock'
    ];
    public function shops() {
        return $this->belongsTo('App\Models\Shop');
    }
}
