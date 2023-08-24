<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminLoginController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

    public function login()
    {
        return view('Admin.login');
    }



    public function checkLogin(Request $request)
    {
        if (Auth::guard('admin')->attempt($request->only('email', 'password'), $request->get('remember'))) {
            return redirect()->route('admin.home');
        }
        return redirect()->back()->withInput(['email' => $request->email]);
    }


    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
