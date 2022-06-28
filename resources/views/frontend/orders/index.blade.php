@extends('frontend.layouts.master')
@section('title')
Đơn hàng
@endsection
@section('content')
<div class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__links">
                    <a href="/"><i class="fa fa-home"></i> Trang chủ</a>
                    <span>Đơn hàng</span>
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
                                <th>Tình trạng</th>
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
                                <td class="label sale"><span class="label sale">{{ $order->status_text ?? 'nội dung trống'}}</span></td>
                                <td class="cart__price">{{ number_format($order->total_price, 2, '.', ',' )}}</td>
                                <td>{{date_format($order->created_at,"d-m-Y")}}</td>
                                <td>
                                    <div class="dropdown btn btn-danger">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                            Hành động <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="{{route('order.detail',$order->id)}}"><i class="bx bx-edit-alt me-1"></i> Xem chi tiết đơn hàng </a>
                                            @php
                                            $disabled1="";
                                            if($order->status>=1){
                                            $disabled1 = "disabled";
                                            }
                                            @endphp
                                            <span><select name="forma" onchange="location = this.value;">
                                                    <option disabled selected>---Cập nhật đơn hàng---</option>
                                                    <option value="{{route('order.require',$order->id)}}" {{$disabled1}}>Yêu cầu hủy đơn hàng</option>
                                                </select></span>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{$orders->links()}}
            </div>
        </div>
        <div class="row">
            <div class="col">
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