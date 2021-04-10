<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('admins.login');
    }

    // 登录验证并保存登录状态
    public function login(Request $request)
    {
        $credentials = $this->validate($request, [
            'username' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $fallback = route('admins.index');

            return redirect()->intended($fallback);
        } else {
            return $request->all();
        }
    }

    // 退出登录
    public function logout()
    {
        Auth::logout();

        return redirect()->route('admin.login');
    }
}
