<section class="banner set-bg" data-setbg="/frontend/img/baner.png">
    <div class="container">
        <div class="row">
            <div class="col-xl-7 col-lg-8 m-auto">
                <div class="banner__slider owl-carousel">
                    @foreach($categoriesByParent as $category)
                    <div class="banner__item">
                        <div class="banner__text">
                            <span>Lựa chọn hàng đầu</span>
                            <h1>{{$category->name}}</h1>
                            <a href="{{route('product.productbycategories', [ 'slug' => $category->slug ])}}">Xem ngay</a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>