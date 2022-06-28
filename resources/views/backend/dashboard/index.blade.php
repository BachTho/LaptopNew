@extends('backend.layouts.master')
@section('title')
Dashboard | LaptopNewAdmin
@endsection
@section('script')
<script>
  @if(session('success')) {
    toastr.success('{{session("success")}}');
  }
  @elseif(session('error')) {
    toastr.error('{{session("error")}}');
  }
  @elseif(session('warning')) {
    toastr.warning('{{session("warning")}}');
  }
  @endif
</script>
@endsection
@section ('header')
@include("backend.includes.header")
@endsection
@section ('content')
<div class="content-wrapper">
  <div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
      <h1>Chào mừng bạn đến với trang quản trị</h1>
    </div>
  </div>
</div>
@endsection