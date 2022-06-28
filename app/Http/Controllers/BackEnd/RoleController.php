<?php

namespace App\Http\Controllers\BackEnd;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles_query = Role::select('*');
        if (!empty($name)) {
            $roles_query = $roles_query->where('name', "LIKE", "%$name%");
        }
        $roles = $roles_query->orderBy('id', 'desc')->paginate(8);
        return view('backend.roles.index')->with([
            'roles' => $roles,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::all();
        return view('backend.roles.create')->with(['permissions' => $permissions]);
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
                'permissions' => 'required',
                'name' => 'required|unique:roles|min:3|max:255',
                'description' => 'required|min:2|max:255',
            ],
            [
                'required' => ' :attribute không được để trống',
                'unique' => 'Tên sản phẩm đã có',
                'min' => ':attribute ít nhất phải 3 kí tự',

            ],
        );

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }
        $role = new Role();
        $role->name = $data['name'];
        $role->description =  $data['description'];
        $role->save();
        $permissions = $request->get('permissions');
        $role->permissions()->attach($permissions);
        session()->flash('success', 'Thêm mới thành công');
        return redirect()->route('backend.roles.index');
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
        $permissions = Permission::all();
        $roles = Role::firstwhere('id', $id);
        return view('backend.roles.update')->with([
            'roles' => $roles,
            'permissions' => $permissions,
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
                'permissions' => 'required',
                'name' => 'required|min:3|max:255',
                'description' => 'required|min:2|max:255',
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
        $role = Role::find($id);
        $role->name = $data['name'];
        $role->description =  $data['description'];
        $role->save();
        $permissions = $request->get('permissions');
        $role->permissions()->sync($permissions);
        session()->flash('success', 'Cập nhật thành công');
        return redirect()->route('backend.roles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Role::destroy($id);
        DB::table('role_permissions')->where('role_id', $id)->delete();
        session()->flash('success', 'Xóa thành công');
        return redirect()->route('backend.roles.index');
    }
}
