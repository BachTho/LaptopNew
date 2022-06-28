<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $images = Image::all();
    
        $name = \request()->get(key: 'name');
        $status = \request()->get(key: 'status');
        $products_query = Product::select('*');
        if (!empty($name)) {
            $products_query = $products_query->where('name', "LIKE", "%$name%");
        }
        if (!empty($status)) {
            $products_query = $products_query->where('status', "=", "$status");
        }
        $products = $products_query->orderBy('id', 'desc')->paginate(8);
        return view('backend.products.index')->with([
            'products' => $products,
            'images' => $images,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('backend.products.create')->with(['categories' => $categories]);
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
                'categories' => 'required',
                'quality' => 'required|integer',
                'name' => 'required|unique:products|min:3|max:255',
                'description' => 'required|min:2|max:255',
                'content' => 'required',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'origin_price' => 'required|numeric',
                'discount_percent' => 'required|numeric',
            ],
            [
                'numeric' => ':attribute phải là số',

                'required' => ' :attribute không được để trống',
                'unique' => 'Tên sản phẩm đã có',
                'integer' => ':attribute phải là số',
                'min' => ':attribute ít nhất phải 3 kí tự',
                'image' => ' :attribute phải là ảnh',
                'mimes' => ' :attribute phải là ảnh có dạng jpeg,png,jpg,gif,svg',
            ],
        );

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }
        $product = new Product();
        $product->name = $data['name'];
        $product->description =  $data['description'];
        $product->content = $data['content'];
        $product->quality = $data['quality'];
        $product->origin_price = $data['origin_price'];
        $product->sale_price = $data['origin_price'] - ($data['origin_price'] * $data['discount_percent']) / 100;
        $product->discount_percent = $data['discount_percent'];
        $product->sold = 0;
        $product->status = 0;
        if (isset($data['check'])) {
            $product->status = 1;
        }
        $product->user_id = auth('admin')->user()->id;
        $product->save();
        $categories = $request->get('categories');
        $product->categories()->attach($categories);
        $userlast = Product::latest('id')->first();
        $image = new Image();
        $image->product_id = $userlast->id;
        if ($request->hasFile('image')) {
            $disk = 'public';
            $path = $request->file('image')->store('public', $disk);
            $image->path = $disk;
            $image->image = $path;
        }
        $image->save();
        session()->flash('success', 'Thêm mới thành công');
        return redirect()->route('backend.products.index');
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
        $categories = Category::all();
        $products = Product::firstwhere('id', $id);
        return view('backend.products.update')->with([
            'products' => $products,
            'categories' => $categories,
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
                'categories' => 'required',
                'quality' => 'required|integer',
                'name' => 'required|min:3|max:255',
                'description' => 'required|min:2',
                'content' => 'required',
                'origin_price' => 'required|numeric',
                'discount_percent' => 'required|numeric',
            ],
            [
                'numeric' => ':attribute phải là số',
                'required' => ' :attribute không được để trống',

                'integer' => ':attribute phải là số',
                'min' => ':attribute ít nhất phải 3 kí tự',
            ],
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)
                ->withInput();
        }

        $product = Product::find($id);
        $product->name = $data['name'];
        $product->description =  $data['description'];
        $product->content = $data['content'];
        $product->quality = $data['quality'];
        $product->origin_price = $data['origin_price'];
        $product->sale_price = $data['origin_price'] - ($data['origin_price'] * $data['discount_percent']) / 100;
        $product->discount_percent = $data['discount_percent'];
        $product->sold = 0;
        $product->status = 0;
        if (isset($data['check'])) {
            $product->status = 1;
        }
        $product->user_id = auth('admin')->user()->id;
        $product->save();
        $categories = $request->get('categories');
        $product->categories()->sync($categories);
        session()->flash('success', 'Cập nhật thành công');
        return redirect()->route('backend.products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Product::destroy($id);
        Image::where('product_id', $id)->delete();
        DB::table('category_products')->where('product_id', $id)->delete();
        session()->flash('success', 'Xóa thành công');
        return redirect()->route('backend.products.index');
    }

    public function UpLoadStatus($id)
    {
        $product = Product::find($id);
        if ($product->status == 0) {
            $product->status = 1;
        } else {
            $product->status = 0;
        }
        $product->save();
        session()->flash('success', 'Cập nhật trạng thái thành công');
        return redirect()->route('backend.products.index');
    }
}
