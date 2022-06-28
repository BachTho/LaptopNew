@extends('backend.layouts.master')
@section('title')
Danh sách user | LaptopNewAdmin
@endsection
@section ('header')
@include("backend.includes.header")
@endsection
@section ('content')
<div class="content-wrapper">
  <!-- Content -->
  <div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
      <div class="col">
        <div class="card">
          <h5 class="card-header">Tài khoản khách hàng</h5>
          <div class="table-responsive text-nowrap">
            <table class="table table-dark">
              <thead>
                <tr>
                  <th>Hình ảnh</th>
                  <th>Tên khách hàng</th>
                  <th>Email</th>
                  <th>Số diện thoại</th>
                  <th>Địa chỉ</th>
                  <th>Ngày tạo</th>
                  <th>Ngày cập nhật</th>
                  <th>Thao tác</th>
                </tr>
              </thead>
              <tbody class="table-border-bottom-0">
                @foreach($users as $user)
                <tr>
                  <td>
                    @if(!empty($user->custom_users->image))
                    <img src="{{ Illuminate\Support\Facades\Storage::disk($user->custom_users->path)->url($user->custom_users->image)}}" alt="anh-danh-muc" class="d-block rounded" height="100" width="100" id="uploadedAvatar">
                    @endif
                  </td>
                  <td>{{$user->name}}</td>
                  <td>{{$user->email}}</td>
                  <td>{{ $user->custom_users->address ?? 'null' }}</td>
                  <td>{{ $user->custom_users->phone ?? 'null' }}</td>
                  <td>{{date_format($user->created_at,"d-m-Y")}}</td>
                  <td>{{date_format($user->updated_at,"d-m-Y")}}</td>
                  <td>
                    <div class="dropdown">
                      <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                        <i class="bx bx-dots-vertical-rounded"></i>
                      </button>
                      <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{ route('backend.users.edit', ['user' => $user->id]) }}"><i class="bx bx-edit-alt me-1"></i> Chỉnh sửa</a>
                        <form method="POST" action="{{ route('backend.users.destroy', $user->id )}} ">
                          @csrf
                          @method ('DELETE')
                          <button class=" dropdown-item btn-sm delete-confirm" data-name="{{$user->name}}">
                            <i class='bx bx-lock-alt'></i>
                            Khóa tài khoản
                          </button>
                        </form>
                      </div>
                    </div>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
            <div class="mt-2">
              {{$users->links()}}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
<script>
  $('.delete-confirm').click(function(event) {
    var form = $(this).closest("form");
    var name = $(this).data("name");
    event.preventDefault();
    swal({
        title: `Bạn có muốn khóa tài khoản: ${name}?`,
        text: "Nếu muốn hãy xác nhận lần nữa",
        icon: "error",
        buttons: ["Không", "Khóa"],
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          toastr.success('{{session("success")}}');
          form.submit();
        }
      });
  });
</script>
@endsection