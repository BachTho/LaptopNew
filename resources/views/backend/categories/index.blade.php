@extends('backend.layouts.master')
@section('title')
Danh sách Danh mục | LaptopNewAdmin
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
                <div class="col-md-3">
                  <label class="form-label" for="selectTypeOpt">Tên danh mục</label>
                  <input type="text" class="form-control  shadow-none" name="name" value="{{ request()->get('name') }}" placeholder="Tìm kiếm danh mục..." aria-label="Search...">
                </div>
                <div class="col-md-3">
                  <label class="form-label" for="selectPlacement">Trạng thái</label>
                  <select class="form-select placement-dropdown" name="status" id="selectPlacement">
                    <option value="{{ request()->get('status') }}"> @if (request()->get('status')==1)
                      Kích hoạt
                      @elseif (request()->get('status')==0) --hủy chọn--
                      @else Vô hiệu
                      @endif
                    </option>
                    <option value="0">--hủy chọn--</option>
                    <option value="1">Kích hoạt</option>
                    <option value="'0'">Vô hiệu</option>
                  </select>
                </div>
                <div class="col-md-3">
                  <label class="form-label" for="showToastPlacement">&nbsp;</label>
                  <button id="showToastPlacement" class="btn btn-primary d-block"><i class='bx bx-filter-alt'> Tìm kiếm</i></button>
                </div>
              </div>
            </form>
          </div>
          <!-- /filter -->
          <div class="table-responsive text-nowrap mb-3">
            <table class="table table-dark">
              <thead>
                <tr>
                  <th>Danh mục cha</th>
                  <th>Danh mục</th>
                  <th>hình ảnh</th>
                  <th>Người tạo</th>
                  <th>Trạng thái</th>
                  <th>Thao tác</th>
                </tr>
              </thead>
              <tbody class="table-border-bottom-0">
                @foreach($categories as $category)
                <tr>
                  <td>
                    {{$category->parentName}}
                  </td>
                  <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{$category->name}}</strong></td>
                  <td>
                    @if(!empty($category->image))
                    <img src="{{ Illuminate\Support\Facades\Storage::disk($category->path)->url($category->image)}}" alt="anh-danh-muc" class="d-block rounded" height="80" width="80" id="uploadedAvatar">
                    @endif
                  </td>

                  <td>{{$category->user->name ?? 'tên người tạo không có'}}</td>
                  <td><span class="badge @if($category->status == 0){
                    bg-danger
                  } @endif bg-success
                   me-1">{{ $category->status_text ?? 'nội dung trống'}}</span></td>
                  <td>
                    <div class="dropdown">
                      <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                        <i class="bx bx-dots-vertical-rounded"></i>
                      </button>
                      <div class="dropdown-menu">
                        <form method="POST" action="{{route('backend.categories.upload', [ 'id' => $category->id ])}}">
                          @csrf
                          @method('PUT')
                          @if($category->status == 0)
                          <button class="dropdown-item btn-sm ">
                            <i class='bx bxs-lock-open-alt'></i> Mở khóa
                          </button>
                          @else
                          <button class="dropdown-item btn-sm ">
                            <i class='bx bxs-lock-alt'></i> Vô hiệu
                          </button>
                          @endif
                        </form>
                        <a class="dropdown-item" href="{{ route('backend.categories.edit', ['category' => $category->id]) }}"><i class="bx bx-edit-alt me-1"></i> Sửa </a>
                        <form method="POST" action="{{ route('backend.categories.destroy', $category->id )}} ">
                          @csrf
                          @method ('DELETE')
                          <button class=" dropdown-item btn-sm delete-confirm" data-name="{{$category->name}}">
                            <i class="bx bx-trash me-1"></i>
                            Xóa danh mục
                          </button>
                        </form>
                      </div>
                    </div>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
        <div class="mt-2"> {{$categories->links() }}</div>
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
          title: `Bạn có muốn xóa danh mục: ${name}?`,
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