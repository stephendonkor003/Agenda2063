<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class AdminPermissionsController extends Controller
{
    public function index()
    {
        Gate::authorize('manage-users');

        $permissions = Permission::orderBy('name')->get();

        return view('admin.permissions', compact('permissions'));
    }

    public function store(Request $request)
    {
        Gate::authorize('manage-users');

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:permissions,name'],
            'description' => ['nullable', 'string', 'max:500'],
        ]);

        Permission::create([
            'name' => $data['name'],
            'slug' => Str::slug($data['name']),
            'description' => $data['description'] ?? null,
        ]);

        return back()->with('status', 'Permission created.');
    }

    public function update(Request $request, Permission $permission)
    {
        Gate::authorize('manage-users');

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('permissions', 'name')->ignore($permission->id)],
            'description' => ['nullable', 'string', 'max:500'],
        ]);

        $permission->update([
            'name' => $data['name'],
            'slug' => Str::slug($data['name']),
            'description' => $data['description'] ?? null,
        ]);

        return back()->with('status', 'Permission updated.');
    }

    public function destroy(Permission $permission)
    {
        Gate::authorize('manage-users');

        if ($permission->slug === 'view-all-departments' || $permission->slug === 'manage-users') {
            return back()->withErrors(['permission' => 'This core permission cannot be deleted.']);
        }

        $permission->delete();

        return back()->with('status', 'Permission deleted.');
    }
}
