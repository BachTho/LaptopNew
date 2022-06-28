@extends('backend.layouts.master')
@section('title')
Tạo danh mục | LaptopNewAdmin
@endsection
@section('script')
<!-- tạo cái ckeditor ghi nội dung -->
<!-- <script src="https://cdn.ckeditor.com/ckeditor5/27.1.0/classic/ckeditor.js"></script> -->
<script src="https://cdn.ckeditor.com/4.18.0/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('summernote');
</script>
@endsection
@section ('content')
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">BÀI VIẾT & SẢN PHẨM /</span> Tạo danh mục</h4>
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <form method="POST" action="{{route('backend.categories.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="defaultSelect" class="form-label">Danh mục cha</label>
                                <select id="defaultSelect" name="parent_id" class="form-select">
                                    <option value="0">--Danh mục cha--</option>
                                    @foreach($categories as $category)
                                    <option value="{{ $category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="card-body">
                            <label class="form-label" for="basic-default-password12">Tên danh mục</label>
                            <div class="form-floating">
                                <input type="text" class="form-control" name="name" value="{{old('name')}}" id="floatingInput" placeholder="VD: Asus" aria-describedby="floatingInputHelp">
                                <label for="floatingInput">Tên danh mục</label>
                            </div>
                            @error('name')
                            <div class="alert alert-danger"> {{$message}}</div>
                            @enderror
                        </div>

                        <div class="card-body">
                            <label class="form-label" for="basic-default-password12">Hình ảnh</label>
                            <div class="form-floating">
                                <div class="input-group">
                                    <input name="image" type="file" class="form-control" id="inputGroupFile01" />
                                </div>
                            </div>
                            @error('image')
                            <div class="alert alert-danger"> {{$message}}</div>
                            @enderror
                        </div>

                        <div class="card-body">
                            <label class="form-label" for="basic-default-password12">Mô tả</label>
                            <div class="form-floating">
                                <textarea name="description" value="{{old('description')}}" id="summernote" cols="100%" rows="10" placeholder="  Giới thiệu sơ qua về danh mục nào!!!"></textarea>
                            </div>
                            @error('description')
                            <div class="alert alert-danger"> {{$message}}</div>
                            @enderror
                        </div>

                        <div class="card-body">
                            <label class="form-label" for="basic-default-password12">Trạng thái danh mục</label>
                            <div class="form-check form-switch mb-2">
                                <input class="form-check-input" name="check" type="checkbox" id="flexSwitchCheckDefault">
                                <label class="form-check-label" for="flexSwitchCheckDefault">Nếu bạn không chọn mặc định là vô hiệu </label>
                            </div>
                        </div>

                        <div class="card-body">
                            <a href="{{route('backend.categories.index')}}" class="btn btn-outline-secondary">Thoát</a>
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