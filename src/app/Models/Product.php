<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Season; // Ensure the Season model exists in the specified namespace

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'description',
        'image_path',   // 画像のパス
    ];

    // seasonsとの多対多リレーションを定義
    public function seasons()
    {
        return $this->belongsToMany(Season::class, 'product_season');
    }
}
