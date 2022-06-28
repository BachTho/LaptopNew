<section class="product spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4">
                <div class="section-title">
                    <h4>Sản phẩm mới ra mắt</h4>
                </div>
            </div>
            <div class="col-lg-8 col-md-8">
                <ul class="filter__controls">
                    <li class="active" data-filter="*">All</li>
                    @foreach($categories as $category)
                    <li data-filter=".{{$category->slug}}">{{$category->name}}</li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="row property__gallery">
            @foreach($products as $product)
            <div class="col-lg-3 col-md-4 col-sm-6 mix @foreach ($product->categories as $category) {{$category->slug}}  @endforeach">
                <div class="product__item">
                    <div class="product__item__pic set-bg" data-setbg="@if(!empty($product->images()->first()))
                  {{ Illuminate\Support\Facades\Storage::disk($product->images()->first()->path)->url($product->images()->first()->image)}}
                    @endif">
                        @if($product->discount_percent >0)
                        <div class="label sale">Giảm giá {{$product->discount_percent}} % </div>
                        @else
                        <div class="label new">New </div>
                        @endif
                        <ul class="product__hover">
                            <li><a href="@if(!empty($product->images()->first()))
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
    </div>
</section>