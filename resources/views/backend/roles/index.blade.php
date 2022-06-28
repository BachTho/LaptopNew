@extends('backend.layouts.master')
@section('title')
Danh sách vai trò| LaptopNewAdmin
@endsection
@section ('content')
<div class="content-wrapper">
  <!-- Content -->
  <div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
      <div class="col">
        <div class="card">
          <!-- filter -->
          <div class="card-body">
            <form>
              <div class="row gx-3 gy-2 align-items-center">
                <div class="col">
                  <label class="form-label" for="selectTypeOpt">Tên vai trò</label>
                  <input type="text" class="form-control  shadow-none" name="name" value="{{ request()->get('name') }}" placeholder="Tìm kiếm vai trò..." aria-label="Search...">
                </div>
                <div class="col">
                  <label class="form-label" for="showToastPlacement">&nbsp;</label>
                  <button id="showToastPlacement" class="btn btn-primary d-block"><i class='bx bx-filter-alt'> Tìm kiếm</i></button>
                </div>
              </div>
            </form>
          </div>
          <div class="table-responsive text-nowrap">
            <table class="table table-dark">
              <thead>
                <tr>
                  <th>Tên vai trò</th>
                  <th>Các quyền</th>
                  <th>Ngày tạo</th>
                  <th>Ngày cập nhật</th>
                  <th>Thao tác</th>
                </tr>
              </thead>
              <tbody class="table-border-bottom-0">
                @foreach($roles as $role)
                <tr>
                  <td> {{($role->name)}}</td>
                  <td>
                    @foreach ($role->permissions as $permission)
                    <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
                      <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" title="" data-bs-original-title="{{$permission->name}}">

                        <small class="badge  bg-label-info me-1 text-capitalize">{{$permission->name}} </small>
                      </li>
                    </ul>
                    @endforeach
                  </td>
                  <td>{{date_format($permission->created_at,"d-m-Y")}}</td>
                  <td>{{date_format($permission->updated_at,"d-m-Y")}}</td>
                  <td>
                    <div class="dropdown">
                      <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                        <i class="bx bx-dots-vertical-rounded"></i>
                      </button>
                      <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{ route('backend.roles.edit', ['role' => $role->id]) }}"><i class="bx bx-edit-alt me-1"></i> Chỉnh sửa</a>

                        <form method="POST" action="{{ route('backend.roles.destroy', $role->id )}} ">
                          @csrf
                          @method ('DELETE')
                          <button class=" dropdown-item btn-sm delete-confirm" data-name="{{$role->name}}">
                            <i class="bx bx-trash me-1"></i>
                            Xóa vai trò
                          </button>
                        </form>
                      </div>
                    </div>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
            <div class="mt-2"> {{$roles->links() }}</div>
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
        title: `Bạn có muốn xóa vai trò: ${name}?`,
        text: "Nếu bạn muốn xóa, hãy ấn xác nhận",
        icon: "error",
        buttons: ["Không", "Xóa"],
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          toastr.success('{{session("delete")}}');
          form.submit();
        }
      });
  });
</script>

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