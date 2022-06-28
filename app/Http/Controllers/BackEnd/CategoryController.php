<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $name = \request()->get(key: 'name');
        $status = \request()->get(key: 'status');
        $categories_query = Category::select('*');
        if (!empty($name)) {
            $categories_query = $categories_query->where('name', "LIKE", "%$name%");
        }
        if (!empty($status)) {
            $categories_query = $categories_query->where('status', "=", "$status");
        }
        $categories = $categories_query->orderBy('id', 'desc')->paginate(5);

        foreach ($categories as $category) {
            if ($category->parent_id != null) {
                $parent = Category::find($category->parent_id);
                $category->parentName = $parent->name;
            } else
                $category->parentName = 'Đây là danh mục cha';
        }
        return view('backend.categories.index')->with([
            'categories' => $categories
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
        return view('backend.categories.create')->with([
            'categories' => $categories
        ]);
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
                'name' => 'required|unique:categories|min:2|max:255',
                'description' => 'required|min:2',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ],
            [
                'required' => ' :attribute không được để trống',
                'unique' => ' :attribute đã tồn tại',
                'min' => ':attribute ít nhất phải 3 kí tự',
                'image' => ' :attribute phải là ảnh',
                'mimes' => ' :attribute phải là ảnh có dạng jpeg,png,jpg,gif,svg',
            ],
        );

        if ($validator->fails()) {
            return redirect('backend/categories/create')
                ->withErrors($validator)
                ->withInput();
        }

        $category = new Category();
        if ($request->hasFile('image')) {
            $disk = 'public';
            $path = $request->file('image')->store('public', $disk);
            $category->path = $disk;
            $category->image = $path;
        }
        $category->status = 0;
        if (isset($data['check'])) {
            $category->status = 1;
        }
        $category->parent_id = $data['parent_id'];
        $category->name = $data['name'];
        $category->description = $data['description'];
        $category->user_id = auth('admin')->user()->id;
        $category->save();
        session()->flash('success', 'Thêm mới thành công');
        return redirect()->route('backend.categories.index');
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
        $categories = Category::firstwhere('id', $id);
        $categorieslist = Category::all();
        return view('backend.categories.update')->with([
            'categories' => $categories,
            'categorieslist' => $categorieslist,
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
                'name' => 'required|min:2|max:255',
                'description' => 'required|min:2',
            ],
            [
                'required' => ' :attribute không được để trống',
                'min' => ':attribute ít nhất phải 3 kí tự',
            ],
        );
        $category = Category::find($id);
        if ($validator->fails()) {
            return back()->withErrors($validator)
                ->withInput();
        }

        if ($request->hasFile('image')) {
            $disk = 'public';
            $path = $request->file('image')->store('public', $disk);
            $category->path = $disk;
            $category->image = $path;
        }
        $category->status = 0;
        if (isset($data['check'])) {
            $category->status = 1;
        }
        $category->parent_id = $data['parent_id'];
        $category->name = $data['name'];
        $category->description = $data['description'];
        $category->user_id = 1;
        $category->save();
        session()->flash('success', 'Cập nhật thành công');
        return redirect()->route('backend.categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Category::destroy($id);
        session()->flash('success', 'Xóa thành công');
        return redirect()->route('backend.categories.index');
    }

    public function UpLoadStatus($id)
    {
        $category = Category::find($id);
        if ($category->status == 0) {
            $category->status = 1;
        } else {
            $category->status = 0;
        }
        $category->save();
        session()->flash('success', 'Cập nhật trạng thái thành công');
        return redirect()->route('backend.categories.index');
    }
}
