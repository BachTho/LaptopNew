@extends('frontend.layouts.master')
@section('title')
Danh sách sản phẩm
@endsection
@section('content')
<div class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__links">
                    <a href="{{route('index')}}"><i class="fa fa-home"></i> Home</a>
                    <span>Tất cả sản phẩm </span>
                </div>
            </div>
        </div>
    </div>
</div>
<section class="shop spad">
    <div class="container">
        <div class="row">
            @include('frontend.products.components.sidebar')
            <div class="col-lg-9 col-md-9">
                <div class="row">
                    @foreach ($products as $product)
                    <div class="col-lg-4 col-md-6">
                        <div class="product__item">
                            <div class="product__item__pic set-bg" data-setbg=" @if(count($product->images) > 0)
                   {{ Illuminate\Support\Facades\Storage::disk($product->images()->first()->path)->url($product->images()->first()->image)}}

                    @endif" style="background-image: url(&quot;/frontend/img/shop/shop-1.jpg&quot;);">
                                @if($product->discount_percent >0)
                                <div class="label sale">Giảm giá {{$product->discount_percent}} % </div>
                                @else
                                <div class="label new">New </div>
                                @endif
                                <ul class="product__hover">
                                    <li><a href="@if(count($product->images) > 0)
                   {{ Illuminate\Support\Facades\Storage::disk($product->images()->first()->path)->url($product->images()->first()->image)}}

                    @endif" class="image-popup"><span class="arrow_expand"></span></a></li>
                                    <li><a href="{{route('product.show',$product->slug)}}"><span class="icon_archive_alt"></span></a></li>
                                    <li><a href="{{route ('add',['id'=>$product->id])}}"><span class="icon_cart_alt"></span></a></li>
                                </ul>
                            </div>
                            <div class="product__item__text">
                                <h6 class="cssContent"><a href="{{route('product.show',$product->slug)}}">{{$product->name}}</a></h6>

                                <div class="product__price">{{ number_format($product->sale_price, 2, '.', '').' đ' }}</div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="col-lg-12 text-center">
                    {{$products->links()}}
                </div>
            </div>
        </div>
    </div>
</section>
@endsection