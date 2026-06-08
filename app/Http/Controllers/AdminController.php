<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Faculty;


class AdminController extends Controller
{
    public function loginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        // dd($request->all());
        $username = $request->username;
        $password = $request->password;

        // Static admin credentials (you can move to DB later)
        if ($username === 'Admin' && $password === '12345678') {
            Session::put('is_admin', true);
            return redirect()->route('admin.dashboard');
        }

        return back()->with('error', 'Invalid Credentials');
    }

    public function dashboard()
    {
        $faculties=Faculty::all();
        return view('dashboard.faculty',compact('faculties'));
    }

    public function logout()
    {
        Session::forget('is_admin');
        return redirect()->route('admin.login');
    }
}
