<div class="col-lg-3 col-md-3">
    <div class="shop__sidebar">
        <div class="sidebar__categories">
            <div class="section-title">
                <h4>Danh mục</h4>
            </div>
            <div class="categories__accordion">
                <div class="accordion" id="accordionExample">
                    @foreach($categories as $category)
                    <div class="card">
                        <a href="{{route('product.productbycategories', [ 'slug' => $category->slug ])}}">{{$category->name}}</a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>