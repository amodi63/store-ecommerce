<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function create()
    {
        return view('dashboard.auth.login');
    }
    public function store(LoginRequest $request)
    {
        // return $request;
        $remember_me = $request->has('remember_me') ? true : false;
        if (Auth::guard('admin')->attempt(['email' => $request->input('email'), 'password' => $request->input('password')], $remember_me)) {
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->back()->with('error', 'خطأ في ادخال البيانات');
        }

    }
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.logout');

    }
}
