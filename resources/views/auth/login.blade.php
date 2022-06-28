@extends('auth.layouts.master')
@section('title')
Đăng nhập | LaptopNew
@endsection
@section('content')
<h4 class="mb-2">Chào mừng bạn quay lại! 👋</h4>
<p class="mb-4">Đăng nhập tài khoản của bạn để tiếp tục</p>

<form id="formAuthentication" class="mb-3" action="{{ route('auth.login')}}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="email" class="form-label">Email hoặc tên tài khoản </label>
        <input type="text" class="form-control" name="email" value="{{ old('name') ?: old('email') }}" placeholder="Nhập Email hoặc tên của bạn... " autofocus />
        @error('email')
        <div class="alert alert-danger"> {{$message}}</div>
        @enderror
    </div>
    <div class="mb-3 form-password-toggle">
        <div class="d-flex justify-content-between">
            <label class="form-label" for="password">Mật khẩu</label>
            <a href="{{route('auth.forgot')}}">
                <small>Quên mật khẩu?</small>
            </a>
        </div>
        <div class="input-group input-group-merge">
            <input type="password" id="password" class="form-control" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />

            <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>

        </div>
        @error('password')
        <div class="alert alert-danger"> {{$message}}</div>
        @enderror
    </div>
    <div class="mb-3">
        <div class="form-check">
            <input class="form-check-input" name="remember" type="checkbox" id="remember-me" />
            <label class="form-check-label" for="remember-me"> Lưu đăng nhập </label>
        </div>
    </div>
    <div class="mb-3">
        <button class="btn btn-primary d-grid w-100" type="submit">Đăng nhập</button>
    </div>
</form>
<p class="text-center">
    <span>Bạn có tài khoản chưa?</span>
    <a href="{{route('auth.register')}}">
        <span>Tạo tài khoản</span>
    </a>
</p>
@endsection