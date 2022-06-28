@extends('backend.layouts.master')
@section('title')
Sửa hình ảnh sản phẩm | LaptopNewAdmin
@endsection
@section ('content')
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Thành phần phụ /</span> Sửa ảnh sản phẩm</h4>
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <h5 class="card-header">Hình ảnh sản phẩm</h5>
                    <form method="POST" action="{{route('backend.images.update', [ 'image' => $images->id ])}}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="defaultSelect" class="form-label">Tên sản phẩm</label>
                                <select id="defaultSelect" name="product_id" class="form-select">
                                    <option value="{{ $images->product->id}}">{{ $images->product->name}}</option>
                                    @foreach($products as $product)
                                    <option value="{{ $product->id}}">{{$product->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('product_id')
                            <div class="alert alert-danger"> {{$message}}</div>
                            @enderror
                        </div>

                        <div class="card-body">
                            <label class="form-label" for="basic-default-password12">Hình ảnh</label>
                            <div class="form-floating">
                                <div class="input-group">
                                    <img src="{{ Illuminate\Support\Facades\Storage::disk($images->path)->url($images->image)}}" alt="ảnh ko tồn tại" class="d-block rounded" height="100" width="100" id="uploadedAvatar">
                                    <div class="d-flex align-items-start align-items-sm-center gap-4 m-2">
                                        <input name="image" type="file" class="form-control" id="inputGroupFile01">
                                    </div>
                                </div>
                            </div>
                            @error('image')
                            <div class="alert alert-danger"> {{$message}}</div>
                            @enderror
                        </div>

                        <div class="card-body">
                            <a href="{{route('backend.images.index')}}" class="btn btn-outline-secondary">Thoát</a>
                            <button type="submit" class="btn btn-primary me-2">Cập nhật</button>
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
</script>
@endsection