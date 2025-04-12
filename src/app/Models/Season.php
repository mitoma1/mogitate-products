<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    use HasFactory;

    // もし名前が変更されている場合、テーブル名を指定する
    // protected $table = 'seasons';

    // 商品との多対多のリレーション
    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_season');
    }
}
