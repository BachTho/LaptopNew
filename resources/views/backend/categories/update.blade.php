@extends('backend.layouts.master')

@section('title')
Sửa danh mục | LaptopNewAdmin
@endsection
@section ('content')
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">BÀI VIẾT & SẢN PHẨM /</span> Sửa đổi danh mục</h4>
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <h5 class="card-header">Danh mục</h5>
                    <form method="POST" action="{{route('backend.categories.update', [ 'category' => $categories->id ])}}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="defaultSelect" class="form-label">Danh mục cha</label>
                                <select id="defaultSelect" name="parent_id" class="form-select">

                                    <option value="{{$categories->id}}">{{ $categories->name}}</option>
                                    <option value="0">--Danh mục cha--</option>
                                    @foreach($categorieslist as $category)
                                    <option value="{{ $category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('parent_id')
                            <div class="alert alert-danger"> {{$message}}</div>
                            @enderror
                        </div>
                        <div class="card-body">
                            <label class="form-label" for="basic-default-password12">Tên danh mục</label>
                            <div class="form-floating">
                                <input type="text" value="{{$categories->name}}" class="form-control" name="name" id="floatingInput" placeholder="VD: Asus" aria-describedby="floatingInputHelp">
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
                                    <img src="{{ Illuminate\Support\Facades\Storage::disk($categories->path)->url($categories->image)}}" alt="ảnh ko tồn tại" class="d-block rounded" height="100" width="100" id="uploadedAvatar">
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
                            <label class="form-label" for="basic-default-password12">Mô tả</label>
                            <div class="form-floating">
                                <textarea name="description" value="{{$categories->description}}" id="summernote" cols="100%" rows="10" placeholder="  Giới thiệu sơ qua về danh mục nào!!!">{{$categories->description}}</textarea>
                            </div>
                            @error('description')
                            <div class="alert alert-danger"> {{$message}}</div>
                            @enderror
                        </div>

                        <div class="card-body">
                            <label class="form-label" for="basic-default-password12">Trạng thái danh mục</label>
                            <div class="form-check form-switch mb-2">
                                <input class="form-check-input" name="check" type="checkbox" id="flexSwitchCheckDefault" @if($categories->status==1)checked @endif>
                                <label class="form-check-label" for="flexSwitchCheckDefault">Nếu bạn không chọn mặc định là vô hiệu</label>
                            </div>
                        </div>
                        
                        <div class="card-body">
                            <a href="{{route('backend.categories.index')}}" class="btn btn-outline-secondary">Thoát</a>
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