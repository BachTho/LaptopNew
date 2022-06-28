@extends('frontend.layouts.master')
@section('title')
Kiểm tra thông tin
@endsection
@section('content')
<div class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__links">
                    <a href="/"><i class="fa fa-home"></i>Trang chủ</a>
                    <span>Kiểm tra thông tin trước khi đặt hàng</span>
                </div>
            </div>
        </div>
    </div>
</div>
<section class="checkout spad">
    <div class="container">
        <form method="POST" action="{{route('checkout.store')}}" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-lg-8">
                    <h5>Thông tin của bạn</h5>
                    <div class="row">
                        @if (auth('admin')->check())
                        <div class="col-lg-12">
                            <div class="checkout__form__input">
                                <p>Họ và tên <span>*</span></p>
                                <input type="text" name="name" value="{{auth('admin')->user()->name}}" />
                            </div>
                            <div class="checkout__form__input">
                                <p>Số điện thoại <span>*</span></p>
                                <input type="text" value="{{auth('admin')->user()->phone}}">
                            </div>
                            <div class="checkout__form__input">
                                <p>Địa chỉ <span>*</span></p>
                                <input type="text" placeholder="Street Address">
                            </div>
                            <div class="checkout__form__input">
                                <p>Town/City <span>*</span></p>
                                <input type="text">
                            </div>
                            <div class="checkout__form__input">
                                <p>Country/State <span>*</span></p>
                                <input type="text">
                            </div>
                            <div class="checkout__form__input">
                                <p>Postcode/Zip <span>*</span></p>
                                <input type="text">
                            </div>
                        </div>
                        @elseif (auth()->check())
                        <div class="col-lg-12">
                            <div class="checkout__form__input">
                                <p>Họ và tên <span>*</span></p>
                                <input type="text" name="fullname" value="{{$users->custom_users->fullname ?? ''}}" />
                            </div>
                            <div class="checkout__form__input">
                                <p>Số điện thoại <span>*</span></p>
                                <input type="text" name="phone" value="{{$users->custom_users->phone ?? ''}}" placeholder="Nhập số điện thoại của bạn">
                            </div>
                            <div class="checkout__form__input">
                                <p>Địa chỉ <span>*</span></p>
                                <input type="text" name="address" value="{{$users->custom_users->address ?? ''}}" placeholder="Nhập địa chỉ của bạn">
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="checkout__order">
                        <h5>Sản phẩm bạn đã đặt</h5>
                        <div class="checkout__order__product">
                            <ul>
                                <li>
                                    <span class="top__text">Sản phẩm</span>
                                    <span class="top__text__right">Giá</span>
                                </li>
                                @foreach ($products as $product)
                                <li>
                                    <p class="cssContent1">{{$product->name}}</p><span>{{ number_format($product->qty * $product->price , 3, '.', ',')}} đ</span>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="checkout__order__total">
                            <ul>
                                <li>Tổng số tiền sản phẩm <span>{{Cart::subtotal().' '.'đ'}}</span></li>
                                <li>Thuế <span>{{Cart::tax().' '.'đ'}}</span></li>
                                <li>Thanh toán <span>{{Cart::total().' '.'đ'}}</span></li>
                                <input type="hidden" name="soluong[]" value="{{Cart::total()}}">
                            </ul>
                        </div>
                        <div class="checkout__order__widget">
                        </div>
                        <button type="submit" class="site-btn">Đặt hàng</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
@endsection