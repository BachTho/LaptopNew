@extends('backend.layouts.master')

@section('title')
Sửa quyền | LaptopNewAdmin
@endsection
@section ('content')
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">VAI TRÒ & QUYỀN SỬ DỤNG /</span> Sửa đổi quyền</h4>
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <form method="POST" action="{{route('backend.permissions.update', [ 'permission' => $permissions->id ])}}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <label class="form-label" for="basic-default-password12">Tên quyền sử dụng</label>
                            <div class="form-floating">
                                <input type="text" value="{{$permissions->name}}" class="form-control" name="name" id="floatingInput" placeholder="VD: Cập nhật" aria-describedby="floatingInputHelp">
                                <label for="floatingInput">Tên quyền</label>
                            </div>
                            @error('name')
                            <div class="alert alert-danger"> {{$message}}</div>
                            @enderror
                        </div>

                        <div class="card-body">
                            <label class="form-label" for="basic-default-password12">Mô tả</label>
                            <div class="form-floating">
                                <textarea name="description" value="{{$permissions->description}}" id="summernote" cols="100%" rows="10" placeholder="  Giới thiệu sơ qua về danh mục nào!!!">{{$permissions->description}}</textarea>
                            </div>
                            @error('description')
                            <div class="alert alert-danger"> {{$message}}</div>
                            @enderror
                        </div>

                        <div class="card-body">
                            <a href="{{route('backend.permissions.index')}}" class="btn btn-outline-secondary">Thoát</a>
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