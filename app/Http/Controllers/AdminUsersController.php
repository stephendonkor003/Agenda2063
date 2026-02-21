<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AdminUsersController extends Controller
{
    public function index(Request $request)
    {
        Gate::authorize('manage-users');

        $user = $request->user();
        $query = User::query()->with(['roles', 'department']);

        if (! $user->canDo('view-all-departments')) {
            $query->where('department_id', $user->department_id);
        }

        $users = $query->orderBy('name')->get();

        $stats = [
            'total' => $query->count(),
            'super_admins' => (clone $query)->where('is_admin', true)->count(),
            'active' => (clone $query)->whereNotNull('email_verified_at')->count(),
            'inactive' => (clone $query)->whereNull('email_verified_at')->count(),
        ];

        $roles = Role::orderBy('name')->get();
        $departments = Department::orderBy('name')->get();

        return view('admin.users', compact('users', 'roles', 'departments', 'stats'));
    }

    public function store(Request $request)
    {
        Gate::authorize('manage-users');

        $user = $request->user();

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'department_id' => ['required', 'exists:departments,id'],
            'role_id' => ['nullable', 'exists:roles,id'],
        ]);

        if (! $user->canDo('view-all-departments')) {
            $data['department_id'] = $user->department_id;
        }

        $newUser = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make('ChangeMe123!'),
            'department_id' => $data['department_id'],
            'is_admin' => false,
        ]);

        $newUser->roles()->sync($data['role_id'] ? [$data['role_id']] : []);

        return back()->with('status', 'User created with temporary password: ChangeMe123! Please update it.');
    }

    public function update(Request $request, User $user)
    {
        Gate::authorize('manage-users');

        $current = $request->user();

        if (! $current->canDo('view-all-departments') && $user->department_id !== $current->department_id) {
            abort(403);
        }

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'department_id' => ['required', 'exists:departments,id'],
            'role_id' => ['nullable', 'exists:roles,id'],
            'is_admin' => ['sometimes', 'boolean'],
        ]);

        if (! $current->canDo('view-all-departments')) {
            $data['department_id'] = $current->department_id;
        }

        $user->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'department_id' => $data['department_id'],
            'is_admin' => $data['is_admin'] ?? $user->is_admin,
        ]);

        $user->roles()->sync($data['role_id'] ? [$data['role_id']] : []);

        return back()->with('status', 'User updated.');
    }

    public function destroy(Request $request, User $user)
    {
        Gate::authorize('manage-users');

        $current = $request->user();

        if (! $current->canDo('view-all-departments') && $user->department_id !== $current->department_id) {
            abort(403);
        }

        if ($current->id === $user->id) {
            return back()->withErrors(['user' => 'You cannot delete yourself.']);
        }

        $user->delete();

        return back()->with('status', 'User removed.');
    }
}
