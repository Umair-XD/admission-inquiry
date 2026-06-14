<?php

namespace App\Http\Controllers\Dashboard\Access;

use App\Enums\RoleEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\UserListRequest;
use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index(UserListRequest $request)
    {
        if ($request->ajax()) {
            return $request->processRequest();
        }

        $roles = Role::orderBy('name')->get();
        $departments = Department::orderBy('name')->get();

        return view('dashboard.access.users.index', compact('roles', 'departments'));
    }

    public function edit(User $user)
    {
        $departments = Department::orderBy('name')->get();
        return view('dashboard.access.users.edit_modal', compact('user', 'departments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'role' => 'required|in:'.implode(',', RoleEnum::getValues()),
            'password' => ['required', Password::min(8)],
            'department_id' => 'nullable|exists:departments,id',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'department_id' => $request->role === RoleEnum::STAFF ? $request->department_id : null,
        ]);

        $user->syncRoles([$request->role]);

        return back()->with('success', 'User created successfully.');
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'role' => 'required|in:'.implode(',', RoleEnum::getValues()),
            'department_id' => 'nullable|exists:departments,id',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'department_id' => $request->role === RoleEnum::STAFF ? $request->department_id : null,
        ]);

        $user->syncRoles([$request->role]);

        // Update password only if provided
        if ($request->filled('password')) {
            $request->validate([
                'password' => [Password::min(8)],
            ]);
            $user->update(['password' => Hash::make($request->password)]);
        }

        return back()->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->with('error', 'You cannot delete your own account.');
        }
        $user->delete();

        return back()->with('success', 'User deleted successfully.');
    }
}
