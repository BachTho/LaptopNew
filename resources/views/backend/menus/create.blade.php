@extends('backend.layouts.master')
@section('title')
Tạo tiêu đề | LaptopNewAdmin
@endsection
@section ('content')
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">THÀNH PHẦN PHỤ /</span> Tạo tiêu đề</h4>
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <form method="POST" action="{{route('backend.menus.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <label class="form-label" for="basic-default-password12">Tên tiêu đề</label>
                            <div class="form-floating">
                                <input type="text" class="form-control" name="name" value="{{old('name')}}" id="floatingInput" placeholder="VD: Trang chủ" aria-describedby="floatingInputHelp">
                                <label for="floatingInput">Tên tiêu đề</label>
                            </div>
                            @error('name')
                            <div class="alert alert-danger"> {{$message}}</div>
                            @enderror
                        </div>

                        <div class="card-body">
                            <label class="form-label" for="basic-icon-default-fullname">url</label>
                            <div class="input-group input-group-merge">
                                <span id="basic-icon-default-fullname2" class="input-group-text"><i class='bx bx-code-curly'></i></span>
                                <input name="url" type="text" class="form-control" id="basic-icon-default-fullname" placeholder=" /home" aria-label="VanA" aria-describedby="basic-icon-default-fullname2">
                            </div>
                            @error('url')
                            <div class="alert alert-danger"> {{$message}}</div>
                            @enderror
                        </div>

                        <div class="card-body">
                            <label class="form-label" for="basic-icon-default-fullname">Vị trí muốn xuất hiện</label>
                            <div class="input-group input-group-merge">
                                <span id="basic-icon-default-fullname2" class="input-group-text"><i class='bx bx-current-location'></i></span>
                                <input name="sort" type="text" class="form-control" id="basic-icon-default-fullname" placeholder=" 1" aria-label=" 1 " aria-describedby="basic-icon-default-fullname2">
                            </div>
                            @error('sort')
                            <div class="alert alert-danger"> {{$message}}</div>
                            @enderror
                        </div>

                        <div class="card-body">
                            <label class="form-label" for="basic-default-password12">Trạng thái menus</label>
                            <div class="form-check form-switch mb-2">
                                <input class="form-check-input" name="check" type="checkbox" id="flexSwitchCheckDefault">
                                <label class="form-check-label" for="flexSwitchCheckDefault">Nếu bạn không chọn mặc định là vô hiệu </label>
                            </div>
                        </div>

                        <div class="card-body">
                            <a href="{{route('backend.menus.index')}}" class="btn btn-outline-secondary">Thoát</a>
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