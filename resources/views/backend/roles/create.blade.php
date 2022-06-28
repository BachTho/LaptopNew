@extends('backend.layouts.master')
@section('title')
Tạo vai trò | LaptopNew - Admin
@endsection
@section ('content')
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">VAI TRÒ & QUYỀN SỬ DỤNG /</span> Tạo vai trò</h4>
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <h5 class="card-header">Tạo vai trò</h5>
                    <form method="POST" action="{{route('backend.roles.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="row gy-3">
                                <div class="col-md">
                                    <label class="form-label d-block" for="basic-default-password12">Các quyền:</label>
                                    @foreach($permissions as $permission)
                                    <div class="form-check d-inline-block  mt-2 ms-2">
                                        <input class="form-check-input " value="{{$permission->id}}" type="checkbox" name="permissions[]" id="defaultCheck1">
                                        <span class="form-check-label" for="defaultCheck1"> {{$permission->name}} </span>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @error('permissions')
                            <div class="alert alert-danger"> {{$message}}</div>
                            @enderror
                        </div>

                        <div class="card-body">
                            <label class="form-label" for="basic-icon-default-fullname">Tên vai trò</label>
                            <div class="input-group input-group-merge">
                                <span id="basic-icon-default-fullname2" class="input-group-text"><i class='bx bxs-user-pin'></i></span>
                                <input name="name" value="{{old('name')}}" type="text" class="form-control" id="basic-icon-default-fullname" placeholder="Admin" aria-label="Laptop asus" aria-describedby="basic-icon-default-fullname2">
                            </div>
                            @error('name')
                            <div class="alert alert-danger"> {{$message}}</div>
                            @enderror
                        </div>

                        <div class="card-body">
                            <label class="form-label" for="basic-default-password12">Mô tả ngắn về vai trò</label>
                            <div class="form-floating">
                                <textarea name="description" value="{{old('description')}}" cols="100%" rows="10" placeholder="  Giới thiệu sơ qua về vai trò nào!!!"></textarea>
                            </div>
                            @error('description')
                            <div class="alert alert-danger"> {{$message}}</div>
                            @enderror
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
</script>
@endsection