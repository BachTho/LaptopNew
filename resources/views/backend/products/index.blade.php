@extends('backend.layouts.master')
@section('title')
Danh sách Sản phẩm | LaptopNewAdmin
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
                  <label class="form-label" for="selectTypeOpt">Tên sản phẩm</label>
                  <input type="text" class="form-control  shadow-none" name="name" value="{{ request()->get('name') }}" placeholder="Tìm kiếm sản phẩm..." aria-label="Search...">
                </div>
                <div class="col">
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
                  <th>Danh mục</th>
                  <th>Tên sản phẩm</th>
                  <th>Hình ảnh</th>
                  <th>Giá bình thường</th>
                  <th>Giá khuyến mãi</th>
                  <th>% giảm giá</th>
                  <th>Số lượng còn</th>
                  <th>Số lượng đã bán</th>
                  <th>Người tạo</th>
                  <th>Trạng thái</th>
                  <th>Ngày tạo</th>
                  <th>Ngày cập nhật</th>
                  <th>Thao tác</th>
                </tr>
              </thead>
              <tbody class="table-border-bottom-0">
                @foreach($products as $product)
                <tr>
                  <td>
                    @foreach ($product->categories as $category)
                    <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
                      <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" title="" data-bs-original-title="{{$category->name}}">
                        <small class="badge  bg-label-info me-1 text-capitalize">{{$category->name}} </small>
                      </li>
                    </ul>
                    @endforeach
                  </td>
                  <td> {{($product->name)}}</td>
                  <td>
                    @if(count($product->images) > 0)
                    <img src="{{ Illuminate\Support\Facades\Storage::disk($product->images()->first()->path)->url($product->images()->first()->image)}} " alt="anh-danh-muc" class="d-block rounded" height="80" width="80" id="uploadedAvatar">
                    @endif
                  </td>
                  <td>{{ number_format($product->origin_price, 2, '.', '').' đ' }}</td>
                  <td>{{ number_format($product->sale_price, 2, '.', '').' đ' }}</td>
                  <td>{{ number_format($product->discount_percent, 2, '.', '') .' %' }}</td>
                  <td>{{$product->quality-$product->sold}}</td>
                  <td>{{$product->sold}}</td>
                  <td>{{$product->user->name ?? 'tên người tạo không có'}}</td>
                  <td><span class="badge @if($product->status == 0){
                    bg-danger
                  } @endif bg-success
                   me-1">{{ $product->status_text ?? 'nội dung trống'}}</span></td>
                  <td>{{date_format($product->created_at,"d-m-Y")}}</td>
                  <td>{{date_format($product->updated_at,"d-m-Y")}}</td>
                  <td>
                    <div class="dropdown">
                      <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                        <i class="bx bx-dots-vertical-rounded"></i>
                      </button>
                      <div class="dropdown-menu">
                        <form method="POST" action="{{route('backend.products.upload', [ 'id' => $product->id ])}}">
                          @csrf
                          @method('PUT')
                          @if($product->status == 0)
                          <button class="dropdown-item btn-sm ">
                            <i class='bx bxs-lock-open-alt'></i> Mở bán
                          </button>
                          @else
                          <button class="dropdown-item btn-sm ">
                            <i class='bx bxs-lock-alt'></i> Ngưng bán
                          </button>
                          @endif
                        </form>
                        <a class="dropdown-item" href="{{ route('backend.products.edit', ['product' => $product->id]) }}"><i class="bx bx-edit-alt me-1"></i> Chỉnh sửa</a>

                        <form method="POST" action="{{ route('backend.products.destroy', $product->id )}} ">
                          @csrf
                          @method ('DELETE')
                          <button class=" dropdown-item btn-sm delete-confirm" data-name="{{$product->name}}">
                            <i class="bx bx-trash me-1"></i>
                            Xóa sản phẩm
                          </button>
                        </form>
                      </div>
                    </div>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
            <div class="mt-2"> {{$products->links() }}</div>
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
        title: `Bạn có muốn xóa sản phẩm: ${name}?`,
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