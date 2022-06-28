<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $email = \request()->get(key: 'email');
        $name = \request()->get(key: 'name');
        $admins_query = Admin::select('*');
        if (!empty($email)) {
            $admins_query = $admins_query->where('email', "LIKE", "%$email%");
        }
        if (!empty($name)) {
            $admins_query = $admins_query->where('name', "LIKE", "%$name%");
        }
        $admins = $admins_query->orderBy('id', 'desc')->paginate(5);
        return view('backend.admins.index')->with([
            'admins' => $admins
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        return view('backend.admins.create')->with([
            'roles' => $roles
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
                'name' => 'required|min:2|max:255',
                'email' => 'required|unique:users|email',
                'password' => 'required',
            ],
            [
                'required' => ' :attribute không được để trống',
                'email.unique' => ':attribute đã được sử dụng',
                'confirmed' => 'Mật khẩu xác nhận phải trùng khớp với mật khẩu',
                'min' => 'Tên đăng nhập ít nhất phải 2 kí tự',
                'email' => 'Email bạn phải đúng định dạng chứ!!!'
            ],
        );

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $admin = new Admin();
        if ($request->hasFile('image')) {
            $disk = 'public';
            $path = $request->file('image')->store('public', $disk);
            $admin->path = $disk;
            $admin->image = $path;
        }

        $admin->name = $data['name'];
        $admin->email = $data['email'];
        $admin->password = Hash::make($data['password']);
        $admin->address = $data['address'];
        $admin->phone = $data['phone'];
        $admin->role_id = $data['role_id'];
        $admin->save();
        session()->flash('success', 'Thêm mới thành công');
        return redirect()->route('backend.admins.index');
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
        $roles = Role::all();
        $admins = Admin::firstwhere('id', $id);
        return view('backend.admins.update')->with([
            'admins' => $admins,
            'roles' => $roles,
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
                'email' => 'required|unique:users|email',
                'password' => 'required',
            ],
            [
                'required' => ' :attribute không được để trống',
                'email.unique' => ':attribute đã được sử dụng',
                'confirmed' => 'Mật khẩu xác nhận phải trùng khớp với mật khẩu',
                'min' => 'Tên đăng nhập ít nhất phải 2 kí tự',
                'email' => 'Email bạn phải đúng định dạng chứ!!!'
            ],
        );

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $admin = Admin::find($id);
        if ($request->hasFile('image')) {
            $disk = 'public';
            $path = $request->file('image')->store('public', $disk);
            $admin->path = $disk;
            $admin->image = $path;
        }

        $admin->name = $data['name'];
        $admin->email = $data['email'];
        $admin->password = Hash::make($data['password']);
        $admin->address = $data['address'];
        $admin->phone = $data['phone'];
        $admin->role_id = $data['role_id'];
        $admin->save();
        session()->flash('success', 'Thêm mới thành công');
        return redirect()->route('backend.admins.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Admin::destroy($id);
        session()->flash('success', 'Xóa thành công');
        return redirect()->route('backend.admins.index');
    }
}
