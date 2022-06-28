<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }

    public function indexAdmin()
    {
        return view('auth.loginAdmin');
    }

    public function username()
    {
        $field = (filter_var(request()->email, FILTER_VALIDATE_EMAIL) || !request()->email) ? 'email' : 'name';
        if ($field != 'email')
            $field = is_numeric(request()->email) ? 'email' : 'name';
        request()->merge([
            $field => request()->email
        ]);
        return $field;
    }

    // front end
    public function authenticate(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                $this->username() => 'required',
                'password' => 'required',
            ],
            [
                'email' => ' :attribute sai ',
                'required' => ' :attribute không được để trống',
            ],
        );

        if ($validator->fails()) {
            return redirect('login')
                ->withErrors($validator)
                ->withInput();
        }

        $credentials = $request->validate([
            $this->username() => 'required',
            'password' => 'required',
        ]);

        //Remember Account
        if ($request->get('remember')) {
            $remember = true;
        } else {
            $remember = false;
        }

        // Login
        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            session()->flash('success', 'Đăng nhập thành công');
            return redirect()->intended('/');
        }

        //Error
        return back()->withErrors([
            'email' => 'Tài khoản hoặc mật khẩu bạn sai'
        ])->withInput();
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    // admin
    public function loginAdmin(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                $this->username() => 'required',
                'password' => 'required',
            ],
            [
                'email' => ' :attribute sai ',
                'required' => ' :attribute không được để trống',
            ],
        );

        if ($validator->fails()) {
            return redirect('backend/login')
                ->withErrors($validator)
                ->withInput();
        }

        $credentials = $request->validate([
            $this->username() => ['required'],
            'password' => ['required'],
        ]);

        if ($request->get('remember')) {
            $remember = true;
        } else {
            $remember = false;
        }

        if (Auth::guard('admin')->attempt($credentials, $remember)) {
            $request->session()->regenerate();
            session()->flash('success', 'Đăng nhập thành công');
            return redirect()->intended('backend/dashboard');
        }

        return back()->withErrors([
            'email' => 'Tài khoản hoặc mật khẩu bạn sai'
        ])->withInput();
    }

    public function logoutAdmin(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
