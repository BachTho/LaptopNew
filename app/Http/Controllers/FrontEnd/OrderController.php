<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Custom_user;
use App\Models\Image;
use App\Models\Order;
use App\Models\Order_product;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        $custom_user = Custom_user::where('user_id', auth()->user()->id)->first();
        $orders = Order::where('custom_id', $custom_user->id)->orderBy('created_at', 'desc')->paginate(5);
        return view('frontend.orders.index')->with(['orders' => $orders]);
    }
    public function Require($id)
    {
        $order = Order::find($id);
        $order->status = 3;
        $order->save();
        return redirect()->back()->with('success', 'Đổi trạng thái thành công');
    }
    public function Detail($id)
    {
        $orders = DB::table('order_products')->where('order_id', $id)->paginate(5);
        return view('frontend.orders.detail')->with([
            'orders' => $orders,

        ]);
    }
}
