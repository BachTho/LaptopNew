@extends('backend.layouts.master')
@section('title')
Danh sách admin | LaptopNewAdmin
@endsection
@section('script')
<script>
  @if(session('success')) {
    toastr.success('{{session("success")}}');
  }
  @endif
</script>
@endsection
@section ('content')
<div class="content-wrapper">
  <!-- Content -->
  <div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
      <div class="col">
        <div class="card">
          <h5 class="card-header">Tài khoản nhân viên</h5>
          <div class="table-responsive text-nowrap">
            <table class="table table-dark">
              <thead>
                <tr>
                  <th>Hình ảnh</th>
                  <th>Tên nhân viên</th>
                  <th>Email</th>
                  <th>Số diện thoại</th>
                  <th>Quyền</th>
                  <th>Ngày tạo</th>
                  <th>Ngày cập nhật</th>
                  <th>Thao tác</th>
                </tr>
              </thead>
              <tbody class="table-border-bottom-0">
                @foreach($admins as $admin)
                <tr>
                  <td>
                    @if(!empty($admin->image))
                    <img src="{{ Illuminate\Support\Facades\Storage::disk($admin->path)->url($admin->image)}}" alt="anh-danh-muc" class="d-block rounded" height="100" width="100" id="uploadedAvatar">
                    @endif
                  </td>
                  <td>{{$admin->name}}</td>
                  <td>{{$admin->email}}</td>
                  <td>{{ $admin->phone ?? 'null' }}</td>
                  <td>{{ $admin->role->name ?? 'null' }}</td>
                  <td>{{date_format($admin->created_at,"d-m-Y")}}</td>
                  <td>{{date_format($admin->updated_at,"d-m-Y")}}</td>
                  <td>
                    <div class="dropdown">
                      <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                        <i class="bx bx-dots-vertical-rounded"></i>
                      </button>
                      <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{ route('backend.admins.edit', ['admin' => $admin->id]) }}"><i class="bx bx-edit-alt me-1"></i> Chỉnh sửa</a>
                        <form method="POST" action="{{ route('backend.admins.destroy', $admin->id )}} ">
                          @csrf
                          @method ('DELETE')
                          <button class=" dropdown-item btn-sm">
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
              {{$admins->links()}}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  @endsection