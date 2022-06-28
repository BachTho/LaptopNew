@extends('backend.layouts.master')
@section('title')
Cập nhật tài khoản | LaptopNewAdmin
@endsection
@section ('header')
@include("backend.includes.header")
@endsection
@section ('content')
@section('script')
<script>
    @if(session('success')) {
        toastr.success('{{session("success")}}');
    }
    @endif
</script>
@endsection
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">TÀI KHOẢN/</span> Sửa đổi tài khoản nhân viên</h4>
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <h5 class="card-header">Tài khoản nhân viên</h5>
                    <form method="POST" action="{{route('backend.admins.update', [ 'admin' => $admins->id ])}}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <label class="form-label" for="basic-icon-default-fullname">Tên tài khoản</label>
                            <div class="input-group input-group-merge">
                                <span id="basic-icon-default-fullname2" class="input-group-text"><i class="bx bx-user"></i></span>
                                <input name="name" value="{{$admins->name}}" type="text" class="form-control" id="basic-icon-default-fullname" placeholder="VanA" aria-label="VanA" aria-describedby="basic-icon-default-fullname2">
                            </div>
                        </div>
                        <div class="card-body">
                            <label class="form-label" for="basic-icon-default-email">Email</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="bx bx-envelope"></i></span>
                                <input value="{{$admins->email}}" name="email" type="text" id="basic-icon-default-email" class="form-control" placeholder="vobachtho" aria-label="vobachtho" aria-describedby="basic-icon-default-email2">
                                <span id="basic-icon-default-email2" class="input-group-text">@gmail.com</span>
                            </div>
                            <div class="form-text">Bạn có thể sử dụng chữ cái, số &amp; dấu chấm</div>
                        </div>

                        <div class="card-body form-password-toggle">
                            <label class="form-label" for="password">Mật khẩu</label>
                            <div class="input-group input-group-merge">
                                <input value="{{$admins->password}}" type="password" id="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
                                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>

                            </div>
                            @error('password')
                            <div class="alert alert-danger"> {{$message}}</div>
                            @enderror
                        </div>

                        <div class="card-body form-password-toggle">
                            <label class="form-label" for="password">Nhập lại mật khẩu</label>
                            <div class="input-group input-group-merge">
                                <input type="password" value="{{$admins->password}}" class="form-control @error('password_confirm') is-invalid @enderror" name="password_confirm" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
                                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                            </div>
                            @error('password_confirm')
                            <div class="alert alert-danger"> {{$message}}</div>
                            @enderror
                        </div>

                        <div class="card-body ">
                            <label class="form-label" for="basic-icon-default-phone">Số điện thoại</label>
                            <div class="input-group input-group-merge">
                                <span id="basic-icon-default-phone2" class="input-group-text"><i class="bx bx-phone"></i></span>
                                <input name="phone" value="{{ $admins->phone ?? 'phone'}}" type="text" id="basic-icon-default-phone" class="form-control phone-mask" placeholder="033 641 8833" aria-label="033 641 8833" aria-describedby="basic-icon-default-phone2">
                            </div>
                        </div>

                        <div class="card-body">
                            <label class="form-label" for="basic-icon-default-company">Địa chỉ</label>
                            <div class="input-group input-group-merge">
                                <span id="basic-icon-default-company2" class="input-group-text"><i class="bx bx-buildings"></i></span>
                                <input value=" {{ $admins->address ?? 'address'}}" name="address" type="text" id="basic-icon-default-company" class="form-control" placeholder="Đồng nai" aria-label="Đồng nai" aria-describedby="basic-icon-default-company2">
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="mb-3">
                                <label for="defaultSelect" class="form-label">Quyền</label>
                                <select id="defaultSelect" name="role_id" class="form-select">
                                    <option value="{{ $admins->role->id}}">{{ $admins->role->name}}</option>
                                    @foreach($roles as $role)
                                    <option value="{{ $role->id}}">{{$role->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('role_id')
                            <div class="alert alert-danger"> {{$message}}</div>
                            @enderror
                        </div>

                        <div class="card-body">
                            <label class="form-label" for="basic-default-password12">Hình ảnh</label>
                            <div class="form-floating">
                                <div class="input-group">
                                    <input name="image" type="file" class="form-control" id="inputGroupFile01">
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <a href="{{route('backend.admins.index')}}" class="btn btn-outline-secondary">Thoát</a>
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
push('stack_scripts')
<script>
    $(function() {
        // Summernote
        $('#summernote').summernote()
        // CodeMirror
        CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
            mode: "htmlmixed",
            theme: "monokai"
        });
    })
</script>
@endsection