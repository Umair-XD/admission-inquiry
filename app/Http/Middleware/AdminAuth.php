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

        $allowed = [RoleEnum::SUPER_ADMIN, RoleEnum::ADMIN, RoleEnum::STAFF];
        if (! in_array(Auth::user()->role, $allowed)) {
            Auth::logout();

            return redirect()->route('admin.login')->with('error', 'Access denied. Unauthorized role.');
        }

        return $next($request);
    }
}
