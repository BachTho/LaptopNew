@extends('frontend.layouts.master')
@section('title')
Chi tiết đơn hàng của bạn
@endsection
@section('content')
<div class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div>
                    <a style="color: #000;" href="/"><i class="fa fa-home"></i> Trang chủ</a>
                    <i class="fa fa-arrow-right"></i><span>Chi tiết đơn hàng của bạn</span>
                </div>
            </div>
        </div>
    </div>
</div>
<section class="shop-cart spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="shop__cart__table">
                    <table>
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Tên sản phẩm</th>
                                <th>Số lượng</th>
                                <th>Giá tiền</th>
                                <th>Tổng giá tiền</th>
                                <th>Ngày mua</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i=1 @endphp
                            @foreach($orders as $order)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>
                                    <div style=" width: 200px; overflow: hidden; white-space: nowrap;   text-overflow: ellipsis;">{{$order->name}}</div>
                                </td>
                                <td>{{$order->quality}}</td>
                                <td>{{$order->price}}</td>
                                <td>{{$order->total_price}}</td>
                                <td>{{date("d/m/Y", strtotime($order->created_at))}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="cart__btn update__btn">
                    <a href="{{route('product.index')}}">Tiếp tục muc sắm</a>
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