<?php

namespace App\Http\Controllers\Dashboard\Access;

use App\Http\Controllers\Controller;
use App\Enums\PermissionEnum;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::with('permissions')->withCount('users')->get();
        $permissions = Permission::orderBy('name')->get()->groupBy(function ($p) {
            // group by the prefix before the dot e.g. "inquiry.view" → "inquiry"
            return ucfirst(explode('.', $p->name)[0]);
        });

        return view('dashboard.access.roles.index', compact('roles', 'permissions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:roles,name',
        ]);

        Role::create(['name' => $request->name, 'guard_name' => 'web']);
        return back()->with('success', 'Role created successfully.');
    }

    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:roles,name,' . $role->id,
        ]);

        $role->update(['name' => $request->name]);

        // Sync permissions
        $permissions = $request->input('permissions', []);
        $role->syncPermissions($permissions);

        return back()->with('success', 'Role updated successfully.');
    }

    public function destroy(Role $role)
    {
        if ($role->name === 'super_admin') {
            return back()->with('error', 'The super_admin role cannot be deleted.');
        }

        $role->delete();
        return back()->with('success', 'Role deleted successfully.');
    }
}
