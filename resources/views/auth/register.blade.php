@extends('auth.layouts.master')
@section('title')
Đăng ký | LaptopNew
@endsection
@section('script')
<script>
    @if(session('error')) {
        toastr.error('{{session("error")}}');
    }
    @endif
</script>
@endsection
@section('content')
<h4 class="mb-2">Tạo tài khoản 🚀</h4>
<p class="mb-4">Đăng ký ngay để có trải nghiệm tốt nhất!!!</p>

<form id="formAuthentication" class="mb-3" action="{{ route('auth.register') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="username" class="form-label ">Tên</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror  " id="username" value="{{old('name')}}" name="name" placeholder="Nhập tên của bạn nào..." autofocus />
        @error('name')
        <div class="alert alert-danger"> {{$message}}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="text" class="form-control @error('email') is-invalid @enderror " id="email" value="{{old('email')}}" name="email" placeholder="Nhập Email của bạn nào..." />
        @error('email')
        <div class="alert alert-danger"> {{$message}}</div>
        @enderror
    </div>
    <div class="mb-3 form-password-toggle">
        <label class="form-label" for="password">Mật khẩu</label>
        <div class="input-group input-group-merge">
            <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
            <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>

        </div>
        @error('password')
        <div class="alert alert-danger"> {{$message}}</div>
        @enderror
    </div>

    <div class="mb-3 form-password-toggle">
        <label class="form-label" for="password">Nhập lại mật khẩu</label>
        <div class="input-group input-group-merge">
            <input type="password" class="form-control @error('password_confirm') is-invalid @enderror" name="password_confirm" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
            <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
        </div>
        @error('password_confirm')
        <div class="alert alert-danger"> {{$message}}</div>
        @enderror
    </div>
    <div class="mb-3">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="terms-conditions" name="check" />
            <label class="form-check-label" for="terms-conditions">
                Tôi đồng ý với
                <a href="{{route('policy')}}">các điều khoản dịch vụ</a>
            </label>
        </div>
    </div>
    <button class="btn btn-primary d-grid w-100">Đăng ký</button>
</form>

<p class="text-center">
    <span>Bạn đã có tài khoản chưa?</span>
    <a href="{{route('auth.login')}}">
        <span>Đăng nhập ngay</span>
    </a>
</p>
@endsection