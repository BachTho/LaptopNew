@extends('backend.layouts.master')
@section('title')
Sửa sản phẩm | LaptopNew - Admin
@endsection
@section ('content')
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Sản phẩm /</span> Sửa sản phẩm</h4>
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <h5 class="card-header">Sửa sản phẩm</h5>
                    <form method="POST" action="{{route('backend.products.update', [ 'product' => $products->id ])}}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="row gy-3">
                                <div class="col-md">
                                    <label class="form-label d-block" for="basic-default-password12">Sản phẩm thuộc danh mục:</label>
                                    @foreach($categories as $item)
                                    @foreach($products->categories as $category_products)
                                    @php
                                    $selected="";
                                    if($category_products-> id == $item->id){
                                    $selected = "checked";
                                    break;
                                    }
                                    @endphp
                                    @endforeach
                                    <div class="form-check d-inline-block  mt-2 ms-2">
                                        <input class="form-check-input " value="{{$item->id}}" type="checkbox" name="categories[]" id="defaultCheck1" {{$selected}}>
                                        <span class="form-check-label" for="defaultCheck1"> {{$item->name}} </span>
                                    </div>
                                    @endforeach

                                </div>
                            </div>
                            @error('categories')
                            <div class="alert alert-danger"> {{$message}}</div>
                            @enderror
                        </div>

                        <div class="card-body">
                            <label class="form-label" for="basic-icon-default-fullname">Tên sản phẩm</label>
                            <div class="input-group input-group-merge">
                                <span id="basic-icon-default-fullname2" class="input-group-text"><i class='bx bx-laptop'></i></span>
                                <input name="name" value="{{$products->name}}" type="text" class="form-control" id="basic-icon-default-fullname" placeholder="Laptop asus" aria-label="Laptop asus" aria-describedby="basic-icon-default-fullname2">
                            </div>
                            @error('name')
                            <div class="alert alert-danger"> {{$message}}</div>
                            @enderror
                        </div>

                        <div class="card-body">
                            <label class="form-label" for="basic-icon-default-fullname">Số lượng</label>
                            <div class="input-group input-group-merge">
                                <span id="basic-icon-default-fullname2" class="input-group-text"><i class='bx bxs-add-to-queue'></i></span>
                                <input name="quality" value="{{$products->quality}}" type="text" class="form-control" id="basic-icon-default-fullname" placeholder="Số lượng" aria-label="Số lượng" aria-describedby="basic-icon-default-fullname2">
                            </div>
                            @error('quality')
                            <div class="alert alert-danger"> {{$message}}</div>
                            @enderror
                        </div>

                        <div class="card-body">
                            <div class="row gy-3">
                                <div class="col-md">
                                    <label class="form-label" for="basic-icon-default-fullname">Giá gốc</label>
                                    <div class="input-group input-group-merge">
                                        <span id="basic-icon-default-fullname2" class="input-group-text"><i class='bx bxs-dollar-circle'></i></span>
                                        <input name="origin_price" value="{{$products->origin_price}}" type="text" class="form-control" id="basic-icon-default-fullname" placeholder="Giá bán" aria-label="Giá bán" aria-describedby="basic-icon-default-fullname2">
                                    </div>
                                    @error('origin_price')
                                    <div class="alert alert-danger"> {{$message}}</div>
                                    @enderror
                                </div>
                                <div class="col-md">
                                    <label class="form-label" for="basic-icon-default-fullname">% giảm giá</label>
                                    <div class="input-group input-group-merge">
                                        <span id="basic-icon-default-fullname2" class="input-group-text"><i class='bx bxs-zap'></i></span>
                                        <input name="discount_percent" value="{{$products->discount_percent}}" type="text" class="form-control" id="basic-icon-default-fullname" placeholder="Nhập % giám giá mà bạn muốn" aria-label="Nhập % giám giá mà bạn muốn" aria-describedby="basic-icon-default-fullname2">
                                    </div>
                                    @error('discount_percent')
                                    <div class="alert alert-danger"> {{$message}}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <label class="form-label" for="basic-default-password12">Mô tả ngắn</label>
                            <div class="form-floating">
                                <textarea name="description" value="{{$products->description}}" cols="100%" rows="10" placeholder="  Giới thiệu sơ qua về sản phẩm nào!!!">{{ $products->description }}</textarea>
                            </div>
                            @error('description')
                            <div class="alert alert-danger"> {{$message}}</div>
                            @enderror
                        </div>

                        <div class="card-body">
                            <label class="form-label" for="basic-default-password12">Chi tiết sản phẩm</label>
                            <div class="form-floating">
                                <textarea name="content" value="{{$products->content}}" id="summernote" cols="100%" rows="10" placeholder=" Chi tiết sản phẩm">{{ $products->content }}</textarea>
                            </div>
                            @error('content')
                            <div class="alert alert-danger"> {{$message}}</div>
                            @enderror
                        </div>


                        <div class="card-body">
                            <label class="form-label" for="basic-default-password12">Trạng thái sản phẩm</label>
                            <div class="form-check form-switch mb-2">
                                <input class="form-check-input" name="check" type="checkbox" id="flexSwitchCheckDefault" @if($products->status==1)checked @endif>
                                <label class="form-check-label" for="flexSwitchCheckDefault">Nếu bạn không chọn mặc định là vô hiệu </label>
                            </div>
                        </div>

                        <div class="card-body">
                            <a href="{{route('backend.products.index')}}" class="btn btn-outline-secondary">Thoát</a>
                            <button type="submit" class="btn btn-primary me-2">Lưu</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- / Content -->

@endsection
@section('script')
<!-- tạo cái ckeditor ghi nội dung -->
<!-- <script src="https://cdn.ckeditor.com/ckeditor5/27.1.0/classic/ckeditor.js"></script> -->
<script src="https://cdn.ckeditor.com/4.18.0/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('summernote');
    CKEDITOR.replace('summernote');
</script>
@endsection