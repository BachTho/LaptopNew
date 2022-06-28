@extends('frontend.layouts.master')
@section('title')
Chi tiết sản phẩm
@endsection
@section('content')
<div class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__links">
                    <a href="/"><i class="fa fa-home"></i> Home ></a>
                    <a href="{{route('product.index')}}">Sản phẩm ></a>
                    <span>{{$products->name}}</span>
                </div>
            </div>
        </div>
    </div>
</div>
<section class="product-details spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="product__details__pic">
                    <div class="product__details__pic__left product__thumb nice-scroll" tabindex="1" style="overflow-y: hidden; outline: none;">
                        @foreach ($products->images as $image)
                        <a class="pt active" href="#product-1">
                            <img src="@if(!empty($image->image))
                  {{ Illuminate\Support\Facades\Storage::disk($image->path)->url($image->image)}}
                    @endif" alt="" />
                        </a>
                        @endforeach
                    </div>
                    <div class="product__details__slider__content">
                        <div class="product__details__pic__slider owl-carousel owl-loaded">
                            <div class="owl-stage-outer">
                                <div class="owl-stage" style="transform: translate3d(0px, 0px, 0px); transition: all 0s ease 0s; width: 1652px;">
                                    @foreach ($products->images as $image)
                                    <div class="owl-item active" style="width: 412.891px;"><img data-hash="product-1" style="height:450px;" class="product__big__img" src="@if(!empty($image->image))
                  {{ Illuminate\Support\Facades\Storage::disk($image->path)->url($image->image)}}
                    @endif" alt=""></div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="owl-nav"><button type="button" role="presentation" class="owl-prev disabled"><i class="arrow_carrot-left"></i></button><button type="button" role="presentation" class="owl-next"><i class="arrow_carrot-right"></i></button></div>
                            <div class="owl-dots disabled"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="product__details__text">
                    <h3>{{$products->name}} <span> <b>Danh mục:</b> @foreach ($products->categories as $category) {{$category->name}}, @endforeach</span></h3>
                    <div class="product__details__price">{{ number_format($products->sale_price, 2, '.', '').' đ' }} <span>{{ number_format($products->origin_price, 2, '.', '').' đ' }}</span></div>
                    <p>{{$products->description}}</p>
                    <div class="product__details__button">
                        <form action="{{route('add',['id' =>$products->id])}}">
                            <div class="quantity">
                                <span>Quantity:</span>
                                <div class="pro-qty"><span></span>
                                    <input name="qty" type="text" value="1">
                                </div>
                            </div>
                            <button type="submit" class="cart-btn"><span class="icon_bag_alt"></span> Thêm giỏi hàng</a>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="product__details__tab">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab">Thông tin chi tiết</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tabs-1" role="tabpanel">
                            <h6>Giới thiệu sản phẩm</h6>
                            <p>{!! $products->content!!}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('frontend.products.components.relatedProducts')
    </div>
</section>
@endsection
@section('script')
<script>
    @if(session('success')) {
        toastr.success('{{session("success")}}');
    }
    @elseif(session('error')) {
        toastr.error('{{session("error")}}');
    }
    @elseif(session('warning')) {
        toastr.warning('{{session("warning")}}');
    }
    @endif
</script>
@endsection