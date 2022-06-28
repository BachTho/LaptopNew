@extends('backend.layouts.master')
@section ('content')
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">BÀI VIẾT & SẢN PHẨM /</span> Sửa đổi danh mục</h4>
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <h5 class="card-header">Danh mục</h5>
                    <form method="POST" action="{{route('backend.users.update', [ 'user' => $users->id ])}}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <label class="form-label" for="basic-icon-default-fullname">Tên tài khoản</label>
                            <div class="input-group input-group-merge">
                                <span id="basic-icon-default-fullname2" class="input-group-text"><i class="bx bx-user"></i></span>
                                <input name="name" value="{{$users->name}}" type="text" class="form-control" id="basic-icon-default-fullname" placeholder="VanA" aria-label="VanA" aria-describedby="basic-icon-default-fullname2">
                            </div>
                        </div>

                        <div class="card-body">
                            <label class="form-label" for="basic-icon-default-fullname">Tên người dùng</label>
                            <div class="input-group input-group-merge">
                                <span id="basic-icon-default-fullname2" class="input-group-text"><i class="bx bx-user"></i></span>
                                <input name="fullname" value="{{$users->custom_users->fullname ?? 'null'}}" type="text" class="form-control" id="basic-icon-default-fullname" placeholder="Văn a" aria-label="Văn a" aria-describedby="basic-icon-default-fullname2">
                            </div>
                        </div>

                        <div class="card-body">
                            <label class="form-label" for="basic-icon-default-email">Email</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="bx bx-envelope"></i></span>
                                <input value="{{$users->email}}" name="email" type="text" id="basic-icon-default-email" class="form-control" placeholder="vobachtho" aria-label="vobachtho" aria-describedby="basic-icon-default-email2">
                                <span id="basic-icon-default-email2" class="input-group-text">@gmail.com</span>
                            </div>
                            <div class="form-text">Bạn có thể sử dụng chữ cái, số &amp; dấu chấm</div>
                        </div>

                        <div class="card-body ">
                            <label class="form-label" for="basic-icon-default-phone">Số điện thoại</label>
                            <div class="input-group input-group-merge">
                                <span id="basic-icon-default-phone2" class="input-group-text"><i class="bx bx-phone"></i></span>
                                <input name="phone" value="{{ $users->custom_users->phone ?? 'phone'}}" type="text" id="basic-icon-default-phone" class="form-control phone-mask" placeholder="033 641 8833" aria-label="033 641 8833" aria-describedby="basic-icon-default-phone2">
                            </div>
                        </div>

                        <div class="card-body">
                            <label class="form-label" for="basic-icon-default-company">Địa chỉ</label>
                            <div class="input-group input-group-merge">
                                <span id="basic-icon-default-company2" class="input-group-text"><i class="bx bx-buildings"></i></span>
                                <input value=" {{ $users->custom_users->address ?? 'address'}}" name="address" type="text" id="basic-icon-default-company" class="form-control" placeholder="Đồng nai" aria-label="Đồng nai" aria-describedby="basic-icon-default-company2">
                            </div>
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
                            <a href="{{route('backend.users.index')}}" class="btn btn-outline-secondary">Thoát</a>
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