@extends('frontend.layouts.master')
@section('title')
Giỏ hàng
@endsection
@section('content')
<div class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__links">
                    <a href="/"><i class="fa fa-home"></i> Trang chủ</a>
                    <span>Giỏi hàng</span>
                </div>
            </div>
        </div>
    </div>
</div>
<section class="shop-cart spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <button class="btn btn-success mb-4"> <a style="color:white" href="{{route('cart.destroy')}}">Làm mới giỏ hàng</a> </button>
                <div class="shop__cart__table">
                    <table>
                        <thead>
                            <tr>
                                <th>Sản phẩm</th>
                                <th>Đơn giá</th>
                                <th>Số lượng</th>
                                <th>Tổng</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                @foreach($products as $product)
                                <td class="cart__product__item">
                                    <div class="cart__product__item__title">
                                        <h6 class="cssContent">{{$product->name}}</h6>
                                    </div>
                                </td>
                                <td class="cart__price">{{ number_format($product->price, 2, '.', ',' )}}</td>
                                <td class="cart__quantity">
                                    <div class="input-group quantity mx-auto" style="width: 100px;">
                                        <div style="width:35% ;" class="input-group-btn">
                                            <button class="btn btn-sm btn-primary btn-minus" style="background:#d19c97;border:0;">
                                                <a href="{{route('carts.minus',['id'=>$product->rowId,'qty'=>$product->qty])}}"><i class="fa fa-minus"></i></a>
                                            </button>
                                        </div>
                                        <input style="width:30% ;" min="1" max="100" name="qty" value="{{ $product->qty }}" type="text">
                                        <div style="width:35% ;" class="input-group-btn">
                                            <button style="background:#d19c97;border:0;" class="btn btn-sm btn-primary btn-plus">
                                                <a href="{{route ('add',['id'=>$product->id])}}"> <i class="fa fa-plus"></i></a>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                                <td class="cart__total">{{ number_format($product->qty * $product->price , 3, '.', ',')}}</td>
                                <td class="cart__close"><a href="{{route('cart.delete',['id'=>$product->rowId])}}"><span class="icon_close"></span></a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="cart__btn">
                    <a href="{{route('product.index')}}">Tiếp tục muc sắm</a>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="cart__total__procced">
                    <h6>Tổng cộng</h6>
                    <ul>
                        <li>Tổng số tiền sản phẩm <span>{{Cart::subtotal().' '.'đ'}}</span></li>
                        <li>Thuế <span>{{Cart::tax().' '.'đ'}}</span></li>
                        <li>Thanh toán <span>{{Cart::total().' '.'đ'}}</span></li>
                    </ul>
                    <a href="{{route('checkout')}}" class="primary-btn">Tiến hành đặt hàng</a>
                </div>
            </div>
        </div>
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