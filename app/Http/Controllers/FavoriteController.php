<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{   /*お気に入りに登録するアクション*/
    public function store($product_id)
     {
         Auth::user()->favorite_products()->attach($product_id);
 
         return back();
     }
     /*お気に入りを削除するアクション*/
     public function destroy($product_id)
     {
         Auth::user()->favorite_products()->detach($product_id);
 
         return back();
     }
}
