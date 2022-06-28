<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Custom_user;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        $products = Cart::content();
        if (Cart::total() == 0) {
            session()->flash('warning', 'Bạn phải mua gì trước chứ!!!');
            return redirect()->route('cart');
        }
        if (!empty(auth()->user()) || !empty(auth('admin')->user())) {
            $users = User::where('id', auth()->user()->id)->first();
            return view('frontend.checkouts.index')->with([
                'products' => $products,
                'users' => $users
            ]);
        } else {
            session()->flash('error', 'Bạn hãy đăng nhập trước');
            return redirect()->route('cart');
        }
    }
    public function store(Request $request)
    {
        $data = $request->all();
        $products = Cart::content();
        $custom_user = Custom_user::where('user_id', auth()->user()->id)->first();
        if ($custom_user == null) {
            $custom_user = new Custom_user();
            if ($request->hasFile('image')) {
                $disk = 'public';
                $path = $request->file('image')->store('public', $disk);
                $custom_user->path = $disk;
                $custom_user->image = $path;
            }
            $custom_user->fullname = $data['fullname'];
            $custom_user->address = $data['address'];
            $custom_user->phone = $data['phone'];
            $custom_user->user_id = auth()->user()->id;
            $custom_user->save();
        } else {
            if ($request->hasFile('image')) {
                $disk = 'public';
                $path = $request->file('image')->store('public', $disk);
                $custom_user->path = $disk;
                $custom_user->image = $path;
            }
            $custom_user->fullname = $data['fullname'];
            $custom_user->address = $data['address'];
            $custom_user->phone = $data['phone'];
            $custom_user->user_id = auth()->user()->id;
            $custom_user->save();
        }

        $order = new Order();
        $order->status = 0;
        $order->custom_id = $custom_user->id;
        $order->total_price = Cart::total();
        $order->save();
        foreach ($products as $item) {
            $data = Product::where('id', '=', $item->id)->get();
            $data[0]->quality = $data[0]->quality - $item->qty;
            $data[0]->save();
            $order->products()->attach(
                $item->id,
                [
                    'name' => $item->name,
                    'price' => $item->price,
                    'quality' => $item->qty,
                    'total_price' => $item->price * $item->qty,
                ]
            );
        }
        Cart::destroy();
        session()->flash('success', 'Mua hàng thành công');
        return redirect()->route('index');
    }
}
