<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::orderBy('id', 'desc')->paginate(5);
        return view('backend.orders.index')->with([
            'orders' => $orders
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $orders = DB::table('order_products')->where('order_id', $id)->paginate(5);
        return view('backend.orders.detailOrder')->with([
            'orders' => $orders
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function Confirmed($id)
    {
        $order = Order::find($id);
        $order->status = 1;
        $order->save();
        return redirect()->route('backend.orders.index')->with('success', 'Đổi trạng thái thành công');
    }
    public function Shipping($id)
    {
        $order = Order::find($id);
        $order->status = 2;
        $order->save();
        return redirect()->route('backend.orders.index')->with('success', 'Đổi trạng thái thành công');
    }
    public function Delivered($id)
    {
        $order = Order::find($id);
        $order->status = 5;
        $order->save();
        return redirect()->route('backend.orders.index')->with('success', 'Đổi trạng thái thành công');
    }
    public function Cancelled($id)
    {
        $order = Order::find($id);
        $order->status = 4;
        $order->save();
        return redirect()->route('backend.orders.index')->with('success', 'Đổi trạng thái thành công');
    }
}
