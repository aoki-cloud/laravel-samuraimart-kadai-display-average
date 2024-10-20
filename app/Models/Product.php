<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Product extends Model
{
    use HasFactory, Sortable;

    /*$fillableにカラムを指定することで、Product::createで商品を登録できるようになる*/
    protected $fillable = [
        'name',
        'description',
        'price',
        'category_id',
        'image',
        'recommend_flag',
        'carriage_flag',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    /*商品1つあたり、複数のレビューがつくことが想定されるためhasManyで一対多の関係性をモデルに追加する*/
    public function reviews()
     {
         return $this->hasMany(Review::class);
     }
    /*多対多のリレーションシップの設定*/
     public function favorited_users() {
        return $this->belongsToMany(User::class)->withTimestamps();
    }
}
