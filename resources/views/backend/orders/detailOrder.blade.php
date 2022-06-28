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
                  <th>STT</th>
                  <th>Tên sản phẩm</th>
                  <th>Số lượng</th>
                  <th>Giá tiền</th>
                  <th>Tổng giá tiền</th>
                  <th>Ngày mua</th>
                </tr>
              </thead>
              <tbody class="table-border-bottom-0">
                @php $i=1 @endphp
                @foreach($orders as $order)
                <tr>
                  <td>{{$i++}}</td>
                  <td>
                    <div style=" width: 200px; overflow: hidden; white-space: nowrap; text-overflow: ellipsis;">{{$order->name}}</div>
                  </td>
                  <td>{{$order->quality}}</td>
                  <td>{{$order->price}}</td>
                  <td>{{$order->total_price}}</td>
                  <td>{{date("d/m/Y", strtotime($order->created_at))}}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <div class="col-1">
      <a class="btn btn-primary d-block" href="{{route('backend.orders.index')}}">Quay lại</a>
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
    @endif
  </script>
  @endsection