<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $name = \request()->get(key: 'name');
        $menus_query = Menu::select('*');
        if (!empty($name)) {
            $menus_query = $menus_query->where('name', "LIKE", "%$name%");
        }
        $menus = $menus_query->orderBy('id', 'desc')->paginate(5);

        return view('backend.menus.index')->with([
            'menus' => $menus
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.menus.create');
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
                'name' => 'required|unique:menus|min:2|max:255',
                'url' => 'required|min:2|max:255',
            ],
            [
                'unique' => ':attribute đã tồn tại',
                'required' => ' :attribute không được để trống',
                'min' => ':attribute ít nhất phải 3 kí tự',
            ],
        );

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $menu = new Menu();
        $menu->status = 0;
        if (isset($data['check'])) {
            $menu->status = 1;
        }
        $menu->name = $data['name'];
        $menu->url = $data['url'];
        $menu->sort = $data['sort'];


        $menu->save();
        session()->flash('success', 'Thêm mới thành công');
        return redirect()->route('backend.menus.index');
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
        $menus = Menu::find($id);

        return view('backend.menus.update')->with(['menus' => $menus,]);
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
                'url' => 'required|max:255',
            ],
            [

                'required' => ' :attribute không được để trống',
                'min' => ':attribute ít nhất phải 3 kí tự',
            ],
        );

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }
        $menu = Menu::find($id);
        $menu->status = 0;
        if (isset($data['check'])) {
            $menu->status = 1;
        }
        $menu->name = $data['name'];
        $menu->url = $data['url'];
        $menu->sort = $data['sort'];
        $menu->save();
        session()->flash('success', 'Cập nhật thành công');
        return redirect()->route('backend.menus.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Menu::destroy($id);
        session()->flash('success', 'Xóa thành công');
        return redirect()->route('backend.menus.index');
    }
}
