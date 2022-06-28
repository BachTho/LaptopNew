@extends('backend.layouts.master')
@section('title')
Tạo quyền sử dụng | LaptopNewAdmin
@endsection
@section ('content')
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Vai trò & quyền sử dụng /</span> Tạo quyền</h4>
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <form method="POST" action="{{route('backend.permissions.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <label class="form-label" for="basic-default-password12">Tên quyền</label>
                            <div class="form-floating">
                                <input type="text" class="form-control" name="name" value="{{old('name')}}" id="floatingInput" placeholder="VD: Cập nhật" aria-describedby="floatingInputHelp">
                                <label for="floatingInput">Tên quyền</label>
                            </div>
                            @error('name')
                            <div class="alert alert-danger"> {{$message}}</div>
                            @enderror
                        </div>

                        <div class="card-body">
                            <label class="form-label" for="basic-default-password12">Mô tả</label>
                            <div class="form-floating">
                                <textarea name="description" value="{{old('description')}}" id="summernote" cols="100%" rows="10" placeholder="  Giới thiệu sơ qua về quyền sử dụng!!!"></textarea>
                            </div>
                            @error('description')
                            <div class="alert alert-danger"> {{$message}}</div>
                            @enderror
                        </div>

                        <div class="card-body">
                            <a href="{{route('backend.permissions.index')}}" class="btn btn-outline-secondary">Thoát</a>
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