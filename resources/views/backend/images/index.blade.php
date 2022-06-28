@extends('backend.layouts.master')
@section('title')
Danh sách hình ảnh | LaptopNewAdmin
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
                  <label class="form-label" for="selectTypeOpt">Tên hình ảnh</label>
                  <input type="text" class="form-control  shadow-none" name="name" value="{{ request()->get('name') }}" placeholder="Tìm kiếm sản phẩm..." aria-label="Search...">
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
                  <th>Sản phẩm</th>
                  <th>hình ảnh</th>
                  <th>Ngày tạo</th>
                  <th>Ngày cập nhật</th>
                  <th>Thao tác</th>
                </tr>
              </thead>
              <tbody class="table-border-bottom-0">
                @foreach($images as $image)
                <tr>
                  <td>{{$image->product->name}}</td>
                  <td>
                    @if(!empty($image->image))
                    <img src="{{ Illuminate\Support\Facades\Storage::disk($image->path)->url($image->image)}}" alt="anh-danh-muc" class="d-block rounded" height="80" width="80" id="uploadedAvatar">
                    @endif
                  </td>
                  <td>{{date_format($image->created_at,"d-m-Y")}}</td>
                  <td>{{date_format($image->updated_at,"d-m-Y")}}</td>
                  <td>
                    <div class="dropdown">
                      <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                        <i class="bx bx-dots-vertical-rounded"></i>
                      </button>
                      <div class="dropdown-menu">

                        <a class="dropdown-item" href="{{ route('backend.images.edit', ['image' => $image->id]) }}"><i class="bx bx-edit-alt me-1"></i> Sửa </a>
                        <form method="POST" action="{{ route('backend.images.destroy', $image->id )}} ">
                          @csrf
                          @method ('DELETE')
                          <button class=" dropdown-item btn-sm delete-confirm" data-name="">
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
        <div class="mt-2"> {{$images->links() }}</div>
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
          title: `Bạn có muốn xóa ảnh này chứ ?`,
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