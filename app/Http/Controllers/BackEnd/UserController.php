<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use App\Models\Custom_user;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
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
        $users_query = User::select('*');
        if (!empty($email)) {
            $users_query = $users_query->where('email', "LIKE", "%$email%");
        }
        if (!empty($name)) {
            $users_query = $users_query->where('name', "LIKE", "%$name%");
        }
        $users = $users_query->orderBy('id', 'desc')->paginate(5);
        return view('backend.users.index')->with([
            'users' => $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.users.create');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = request();
        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $user = User::latest('id')->first();
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
        $custom_user->user_id = $user->id;
        $custom_user->save();
        session()->flash('success', 'Thêm mới thành công');
        return redirect()->route('backend.users.index');
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
        $users = User::firstwhere('id', $id);
        return view('backend.users.update', ['users' => $users]);
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
        $user =  User::find($id);
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->save();
        $custom_user = Custom_user::where('user_id', '=', $user->id)->first();
        if ($custom_user == null) {
            $custom_user = new Custom_user();
        }

        if ($request->hasFile('image')) {
            $disk = 'public';
            $path = $request->file('image')->store('public', $disk);
            $custom_user->path = $disk;
            $custom_user->image = $path;
        }
        $custom_user->user_id = $user->id;
        $custom_user->address = $data['address'];
        $custom_user->phone = $data['phone'];
        $custom_user->fullname = $data['fullname'];
        $custom_user->save();
        session()->flash('success', 'Cập nhật thành công');
        return redirect()->route('backend.users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id);
        session()->flash('success', 'Xóa thành công');
        return redirect()->route('backend.users.index');
    }

    //list da xoa mem
    public function listSoftDelete()
    {
        $users = User::onlyTrashed()->get();
        return view('backend.users.listsoftdelete')->with([
            'users' => $users
        ]);
    }

    public function restoreUser($id)
    {
        User::withTrashed()->where('id', $id)->restore();
        session()->flash('success', 'Mở khóa thành công');
        return redirect()->route('backend.users.delete');
    }
    
    public function delete($id)
    {
        $user = User::where('id', $id)->first();
        $user->delete();
        session()->flash('success', 'Xóa thành công');
        return redirect()->route('backend.users.index');
    }
}
