@extends('backend.layouts.master')
@section('title')
Danh sách Đơn hàng | LaptopNewAdmin
@endsection
@section ('content')
<div class="content-wrapper">
  <!-- Content -->
  <div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
      <div class="col">
        <div class="card">
          <div class="table-responsive text-nowrap mb-3">
            <table class="table table-dark">
              <thead>
                <tr>
                  <th>Người mua</th>
                  <th>Số tiền mua hàng</th>
                  <th>Ngày tạo</th>
                  <th>Ngày sử lý</th>
                  <th>Trạng thái</th>
                  <th>Thao tác</th>
                </tr>
              </thead>
              <tbody class="table-border-bottom-0">
                @foreach($orders as $order)
                <tr>
                  <td> {{$order->custom_id}} </td>
                  <td> {{$order->total_price}} đ</td>
                  <td>{{date_format($order->created_at,"d-m-Y")}}</td>
                  <td>{{date_format($order->updated_at,"d-m-Y")}}</td>
                  <td><span class="badge @if($order->status == 0){
                    bg-danger
                  } @endif badge bg-label-primary
                   me-1">{{ $order->status_text ?? 'nội dung trống'}}</span></td>
                  <td>
                    <div class="dropdown">
                      <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                        <i class="bx bx-dots-vertical-rounded"></i>
                      </button>
                      <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{route('backend.orders.show',$order->id)}}"><i class="bx bx-edit-alt me-1"></i> Xem chi tiết đơn hàng </a>
                        @php
                        $disabled1="";
                        $disabled2="";
                        $disabled3="";
                        $disabled4="";
                        $disabled5="";
                        if($order->status>=0){
                        $disabled1 = "disabled";
                        }
                        if($order->status>=1){
                        $disabled2 = "disabled";
                        }
                        if($order->status>=2){
                        $disabled3 = "disabled";
                        }
                        if($order->status>=3){
                        $disabled4 = "disabled";
                        }
                        if($order->status>=4){
                        $disabled5 = "disabled";
                        }
                        @endphp
                        <span><select name="forma" onchange="location = this.value;">
                            <option disabled selected>---Cập nhật đơn hàng---</option>
                            <option value="" {{$disabled1}}>Đã đặt hàng</option>
                            <option value="{{route('backend.orders.confirmed',$order->id)}}" {{$disabled2}}>Đơn hàng đã được xác nhận</option>
                            <option value="{{route('backend.orders.shipping',$order->id)}}" {{$disabled3}}>Đang vận chuyển</option>
                            <option value="{{route('backend.orders.delivered',$order->id)}}" {{$disabled4}}>Đã giao hàng</option>
                            <option value="{{route('backend.orders.cancelled',$order->id)}}" {{$disabled5}}>Đơn hàng bị hủy</option>
                          </select></span>
                      </div>
                    </div>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
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