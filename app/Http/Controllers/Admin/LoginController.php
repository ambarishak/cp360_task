<?php

namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController
{
    public function login(){
        return view('admin.login');
    }
    public function doLogin(Request $request)
    {
        $validatedData = $request->validate([
            'username' => ['required'],
            'password' => ['required']
        ]);

        $credentials = $request->only('username', 'password');

        if (Auth::guard('admin')->attempt($credentials)) {
            if (Auth::guard('admin')->check()) {
                $request->session()->regenerate();
                return redirect()->route('admin.dashboard');
            }
        }
        return redirect()->back()->withErrors(['credential' => 'Invalid credentials']);
    }
    public function logout(Request $request)
    {
        Auth::guard("admin")->logout();
        $request->session()->invalidate();
        $request->session()->regenerate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login');
    }
}
