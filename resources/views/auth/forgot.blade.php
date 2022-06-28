@extends('auth.layouts.master')
@section('title')
Quên mật khẩu| LaptopNew
@endsection
@section('content')
<div class="card-body">
  <h4 class="mb-2">Bạn quên mật khẩu? 🔒</h4>
  <p class="mb-4">Hãy nhập email của bạn, chúng tôi sẽ gửi cho bạn mã qua email đó!!!</p>
  <form id="formAuthentication" class="mb-3" action="index.html" method="POST">
    <div class="mb-3">
      <label for="email" class="form-label">Email</label>
      <input type="text" class="form-control" id="email" name="email" placeholder="Nhập email của bạn..." autofocus="">
    </div>
    <button class="btn btn-primary d-grid w-100">Gửi mã xác nhận</button>
  </form>
  <div class="text-center">
    <a href="auth-login-basic.html" class="d-flex align-items-center justify-content-center">
      <i class="bx bx-chevron-left scaleX-n1-rtl bx-sm"></i>
      Quay lại đăng nhập
    </a>
  </div>
</div>
@endsection