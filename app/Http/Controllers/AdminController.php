<?php

namespace App\Http\Controllers;

use App\Enums\RoleEnum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function loginForm()
    {
        // Already logged in as admin? Go straight to dashboard
        $allowed = [RoleEnum::SUPER_ADMIN, RoleEnum::ADMIN, RoleEnum::STAFF];
        if (Auth::check() && in_array(Auth::user()->role, $allowed)) {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $allowed = [RoleEnum::SUPER_ADMIN, RoleEnum::ADMIN, RoleEnum::STAFF];
            if (! in_array(Auth::user()->role, $allowed)) {
                Auth::logout();

                return back()->with('error', 'Access denied. Unauthorized role.');
            }

            $request->session()->regenerate();

            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors([
            'email' => 'Invalid email or password.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}
