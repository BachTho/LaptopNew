<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Models\User;
use illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisteredController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

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
            return redirect('register')
                ->withErrors($validator)
                ->withInput();
        }

        if (isset($data['check'])) {
            if ($data['check'] == 'on') {
                $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                ]);
            }

            session()->flash('success', 'Đăng kí thành công');
            Auth::login($user);
            // cach 2
            // Auth::loginUsingId($user->id);
            return redirect('/');

        } else {
            session()->flash('error', 'Bạn phải đồng ý các điều khoản!!!');
            return redirect('register')->withInput();
        }
    }
}
