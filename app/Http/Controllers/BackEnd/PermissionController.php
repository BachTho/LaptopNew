<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $name = \request()->get(key: 'name');
        $permissions_query = Permission::select('*');
        if (!empty($name)) {
            $permissions_query = $permissions_query->where('name', "LIKE", "%$name%");
        }
        $permissions = $permissions_query->orderBy('id', 'desc')->paginate(5);

        return view('backend.permissions.index')->with([
            'permissions' => $permissions
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.permissions.create');
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
                'name' => 'required|unique:permissions|min:2|max:255',
                'description' => 'required|min:2|max:255',
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

        $permission = new Permission();
        $permission->name = $data['name'];
        $permission->description = $data['description'];
        $permission->save();
        session()->flash('success', 'Thêm mới thành công');
        return redirect()->route('backend.permissions.index');
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
        $permissions = Permission::firstwhere('id', $id);;
        return view('backend.permissions.update')->with([
            'permissions' => $permissions
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
                'description' => 'required|min:2|max:255',
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

        $permission = Permission::find($id);
        $permission->name = $data['name'];
        $permission->description = $data['description'];
        $permission->save();
        session()->flash('success', 'Cập nhật thành công');
        return redirect()->route('backend.permissions.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Permission::destroy($id);
        session()->flash('success', 'Xóa thành công');
        return redirect()->route('backend.permissions.index');
    }
}
