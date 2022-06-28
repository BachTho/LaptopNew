<div class="row">
    <div class="col-lg-12 text-center">
        <div class="related__title">
            <h5>Sản phẩm liên quan</h5>
        </div>
    </div>
    @foreach ($productTop3Sale as $product)
    <div class="col-lg-3 col-md-4 col-sm-6">
        <div class="product__item">
            <div class="product__item__pic set-bg" data-setbg="@if(!empty($product->images()->first()))
                  {{ Illuminate\Support\Facades\Storage::disk($product->images()->first()->path)->url($product->images()->first()->image)}}
                    @endif" style="background-image: url(&quot;/frontend/img/product/related/rp-1.jpg&quot;);">
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
                <h6><a href="#" class="cssContent">{{$product->name}}</a></h6>

                <div class="product__price ">{{ number_format($product->sale_price, 2, '.', '').' đ' }}</div>
            </div>
        </div>
    </div>
    @endforeach
</div>