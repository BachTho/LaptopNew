<section class="trend spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="trend__content">
                    <div class="section-title">
                        <h4>Sản phẩm mới</h4>
                    </div>

                    @foreach ($productTop3Create as $product)
                    <div class="trend__item">
                        <a href="{{route('product.show',$product->slug)}}">
                            <div class="trend__item__pic">

                                <img style="height: 90px" src="@if(!empty($product->images()->first()))
                  {{ Illuminate\Support\Facades\Storage::disk($product->images()->first()->path)->url($product->images()->first()->image)}}
                    @endif" alt="">
                            </div>
                            <div class="trend__item__text">
                                <h6 class="cssContent">{{$product->name}}</h6>
                                <div class="product__price">{{ number_format($product->sale_price, 2, '.', '').' đ' }}</div>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="trend__content">
                    <div class="section-title">
                        <h4>Sản phẩm đang giảm mạnh</h4>
                    </div>
                    @foreach ($productTop3Sale as $product)
                    <div class="trend__item">
                        <a href="{{route('product.show',$product->slug)}}">
                            <div class="trend__item__pic">
                                <img style="height: 90px" src="@if(!empty($product->images()->first()))
                  {{ Illuminate\Support\Facades\Storage::disk($product->images()->first()->path)->url($product->images()->first()->image)}}
                    @endif" alt="">
                            </div>
                            <div class="trend__item__text">
                                <h6 class="cssContent">{{$product->name}}</h6>

                                <div class="product__price">{{ number_format($product->sale_price, 2, '.', '').' đ' }}</div>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="trend__content">
                    <div class="section-title">
                        <h4>Sản phẩm tương lai</h4>
                    </div>
                    @foreach ($productTop3feature as $product)
                    <div class="trend__item">
                        <a href="{{route('product.show',$product->slug)}}">
                            <div class="trend__item__pic">
                                <img style="height: 90px" src="@if(!empty($product->images()->first()))
                  {{ Illuminate\Support\Facades\Storage::disk($product->images()->first()->path)->url($product->images()->first()->image)}}
                    @endif" alt="">
                            </div>
                            <div class="trend__item__text">
                                <h6 class="cssContent">{{$product->name}}</h6>

                                <div class="product__price">{{ number_format($product->sale_price, 2, '.', '').' đ' }}</div>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>