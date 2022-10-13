<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    // テーブル名
    protected $table = 'shops';
    // 可変項目
    protected $fillable =[
        'user_id',
        'name',
        'description'
    ];
}
