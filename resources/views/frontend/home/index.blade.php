@extends('frontend.layouts.master')
@section('title')
Trang chủ
@endsection
@section('content')
<!-- categories -->
@include('frontend.home.components.categories')
<!-- Categories Section End -->

<!-- Product Section Begin -->
<!-- productbycreate -->
@include('frontend.home.components.productsTopCreate')
<!-- Product Section End -->

<!-- Banner Section Begin -->
@include('frontend.home.components.baner')
<!-- Banner Section End -->

<!-- Trend Section Begin -->
@include('frontend.home.components.trend')
<!-- Trend Section End -->

<!-- Services Section Begin -->
<section class="services spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="services__item">
                    <i class="fa fa-car"></i>
                    <h6>Miễn phí vận chuyển</h6>
                    <p>Cho các đơn hàng</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="services__item">
                    <i class="fa fa-money"></i>
                    <h6>Thanh toán nhanh chóng</h6>
                    <p>An toàn, an tâm</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="services__item">
                    <i class="fa fa-support"></i>
                    <h6>Hỗ trợ 24/7</h6>
                    <p>Luôn luôn có mặt</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="services__item">
                    <i class="fa fa-headphones"></i>
                    <h6>Luôn tiếp nhận ý kiến</h6>
                    <p>Luôn cập nhật và lắng nghe góp ý</p>
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
    @endif
</script>
@endsection