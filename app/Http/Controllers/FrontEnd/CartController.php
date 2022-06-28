<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartController extends Controller
{
    public function add(Request $request, $id)
    {
        $data = $request->all();
        if (!empty($data['qty'])) {
            $qty = $data['qty'];
        } else if (empty($data['qty'])) {
            $qty = 1;
        } else if ($data['qty'] == 0) {
            $request->session()->flash('error', 'Vui lòng chọn số lượng lớn hơn 0');
            return redirect()->back();
        }
        $product = Product::find($id);
        if ($qty > $product->quality) {
            $request->session()->flash('error', 'Mặt hàng chỉ còn ' . $product->quality . ' sản phẩm');
            return redirect()->back();
        } else {
            Cart::add($product->id, $product->name, $qty, $product->origin_price);
            return redirect()->route('cart')->with('success', 'Thêm vào giỏ hàng thành công');
        }
    }


    public function index()
    {
        $products = Cart::content();
        $imgProduct = Product::get();
        return view('frontend.carts.index')->with([
            'products' => $products,
            'imgProduct' => $imgProduct
        ]);
    }

    public function minus($id, $qty)
    {
        Cart::update($id, $qty - 1);
        return redirect()->route('cart')->with('error', 'Sản phẩm đã giảm đi một');
    }

    public function delete($id)
    {
        Cart::remove($id);;
        return redirect()->route('cart')->with('error', 'Xóa khỏi giỏ hàng thành công');
    }

    public function destroy()
    {
        Cart::destroy();
        return redirect()->route('cart')->with('success', 'Giỏi hàng đang trống');
    }
}
