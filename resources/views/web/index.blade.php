@extends('layouts.app')
 
 @section('content')
 <div class="row">
     <div class="col-2">
         @component('components.sidebar', ['categories' => $categories, 'major_categories' => $major_categories])
         @endcomponent
     </div>
     <div class="col-9">
         <h1>おすすめ商品</h1>
         <div class="row">
             @foreach ($recommend_products as $recommend_product)
             <div class="col-4">
                 <a href="{{ route('products.show', $recommend_product) }}">
                     @if ($recommend_product->image !== "")
                     <img src="{{ asset($recommend_product->image) }}" class="img-thumbnail">
                     @else
                     <img src="{{ asset('img/dummy.png')}}" class="img-thumbnail">
                     @endif
                 </a>
                 <div class="row">
                     <div class="col-12">
                         <p class="samuraimart-product-label mt-2">
                             {{ $recommend_product->name }}<br>
                             <span class="samuraimart-star-rating" data-rate="{{$recommend_product->reviews->avg('score')}}"></span> <!-- 平均評価を表示 -->
                             <label>￥{{ $recommend_product->price }}</label>
                         </p>
                     </div>
                 </div>
             </div>
             @endforeach

         <div class="d-flex justify-content-between">
            <h1>新着商品</h1>
            <a href="{{ route('products.index', ['sort' => 'id', 'direction' => 'desc']) }}">もっと見る</a>
         </div>
         <div class="row">
            @foreach ($recently_products as $recently_product)
                 <div class="col-3">
                     <a href="{{ route('products.show', $recently_product) }}">
                         @if ($recently_product->image !== "")
                             <img src="{{ asset($recently_product->image) }}" class="img-thumbnail">
                         @else
                             <img src="{{ asset('img/dummy.png')}}" class="img-thumbnail">
                         @endif
                     </a>
                     <div class="row">
                         <div class="col-12">
                             <p class="samuraimart-product-label mt-2">
                                 {{ $recently_product->name }}<br>
                                 @if ($recently_product->reviews()->exists())
                                 <!--商品のレビューの平均値を2倍したあと四捨五入し、2で割れば平均評価を0.5刻みで算出できる-->
                                 <span class="samuraimart-star-rating" data-rate="{{ round($recently_product->reviews->avg('score') * 2) / 2 }}"></span>
                                 <!--ound()関数の第2引数に1を指定し、単純に小数点以下第二位を四捨五入し、テキストによる平均評価は0.1刻みで表示-->
                                 {{ round($recently_product->reviews->avg('score'), 1) }}<br>
                                 @endif
                                 <label>￥{{ $recently_product->price }}</label>
                             </p>
                         </div>
                     </div>
                 </div>
             @endforeach
         </div>
     </div>
 </div>
 @endsection