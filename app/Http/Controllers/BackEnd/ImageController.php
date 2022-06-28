<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $images_query = Image::select('*');
        if (!empty($name)) {
            $images_query = $images_query->where('name', "LIKE", "%$name%");
        }
        $images = $images_query->orderBy('id', 'desc')->paginate(5);
        return view('backend.images.index')->with([
            'images' => $images
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::all();
        return view('backend.images.create')->with(['products' => $products]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make(
            $request->all(),
            [
                'product_id' => 'required',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ],
            [
                'required' => ' :attribute không được để trống',
                'image' => ' :attribute phải là ảnh',
                'mimes' => ' :attribute phải là ảnh có dạng jpeg,png,jpg,gif,svg',
            ],
        );

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }
        $image = new Image();
        $image->product_id = $data['product_id'];
        if ($request->hasFile('image')) {
            $disk = 'public';
            $path = $request->file('image')->store('public', $disk);
            $image->path = $disk;
            $image->image = $path;
        }

        $image->save();
        session()->flash('success', 'Thêm mới thành công');
        return redirect()->route('backend.images.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $images = Image::firstwhere('id', $id);
        $products = Product::all();
        return view('backend.images.update')->with([
            'images' => $images,
            'products' => $products,
        ]);
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
        $data = $request->all();
        $validator = Validator::make(
            $request->all(),
            [
                'product_id' => 'required',
            ],
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)
                ->withInput();
        }

        $image = Image::find($id);
        if ($request->hasFile('image')) {
            $disk = 'public';
            $path = $request->file('image')->store('public', $disk);
            $image->path = $disk;
            $image->image = $path;
        }
        $image->product_id = $data['product_id'];
        $image->save();
        session()->flash('success', 'Cập nhật thành công');
        return redirect()->route('backend.images.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Image::destroy($id);
        session()->flash('success', 'Xóa thành công');
        return redirect()->route('backend.images.index');
    }
}
