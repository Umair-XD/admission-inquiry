<?php

namespace App\Http\Middleware;

use App\Enums\RoleEnum;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminAuth
{
    /**
     * Ensure the user is authenticated and has the super_admin role.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! Auth::check()) {
            return redirect()->route('admin.login');
        }

        if (Auth::user()->role !== RoleEnum::SUPER_ADMIN) {
            Auth::logout();

            return redirect()->route('admin.login')->with('error', 'Access denied. Unauthorized role.');
        }

        return $next($request);
    }
}
