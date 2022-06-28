<section class="categories">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 p-0">
                @foreach ($categoriesTop1 as $category)
                <div class="categories__item categories__large__item set-bg" data-setbg=" @if(!empty($category->image))
                  {{ Illuminate\Support\Facades\Storage::disk($category->path)->url($category->image)}}
                    @endif">
                    <div class="categories__text">
                        <h1>{{$category->name}}</h1>
                        <div class="cssContent">{!!$category->description!!}</div>
                        <a href="{{route('product.productbycategories', [ 'slug' => $category->slug ])}}">Xem ngay</a>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="col-lg-6">
                <div class="row">
                    @foreach ($categoriesTop4 as $category)
                    <div class="col-lg-6 col-md-6 col-sm-6 p-0">
                        <div class="categories__item set-bg" data-setbg=" @if(!empty($category->image))
                  {{ Illuminate\Support\Facades\Storage::disk($category->path)->url($category->image)}}
                    @endif">
                            <div class="categories__text">
                                <h4>{{$category->name}}</h4>
                                <div class="cssContent">{!!$category->description!!}</div>
                                <a href="{{route('product.productbycategories', [ 'slug' => $category->slug ])}}">Xem ngay</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>