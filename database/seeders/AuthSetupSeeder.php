<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class AuthSetupSeeder extends Seeder
{
    public function run(): void
    {
        // Departments
        $departments = collect([
            ['name' => 'Planning & Monitoring'],
            ['name' => 'Communications'],
            ['name' => 'Data & Analytics'],
            ['name' => 'Knowledge Management'],
        ])->map(function ($dept) {
            return Department::firstOrCreate(
                ['slug' => Str::slug($dept['name'])],
                ['name' => $dept['name'], 'description' => $dept['name']]
            );
        })->keyBy('slug');

        // Roles
        $roles = collect([
            ['name' => 'Super Admin', 'slug' => 'super-admin'],
            ['name' => 'Department Admin', 'slug' => 'department-admin'],
            ['name' => 'Editor', 'slug' => 'editor'],
            ['name' => 'Viewer', 'slug' => 'viewer'],
        ])->map(function ($role) {
            return Role::firstOrCreate(
                ['slug' => $role['slug']],
                ['name' => $role['name'], 'description' => $role['name']]
            );
        })->keyBy('slug');

        // Permissions
        $permissions = collect([
            ['name' => 'Manage Users', 'slug' => 'manage-users'],
            ['name' => 'Manage Content', 'slug' => 'manage-content'],
            ['name' => 'View Reports', 'slug' => 'view-reports'],
            ['name' => 'View All Departments', 'slug' => 'view-all-departments'],
        ])->map(function ($perm) {
            return Permission::firstOrCreate(
                ['slug' => $perm['slug']],
                ['name' => $perm['name'], 'description' => $perm['name']]
            );
        })->keyBy('slug');

        // Attach permissions to roles
        $roles['super-admin']->permissions()->sync($permissions->pluck('id'));
        $roles['department-admin']->permissions()->sync([
            $permissions['manage-users']->id,
            $permissions['manage-content']->id,
            $permissions['view-reports']->id,
        ]);
        $roles['editor']->permissions()->sync([
            $permissions['manage-content']->id,
            $permissions['view-reports']->id,
        ]);
        $roles['viewer']->permissions()->sync([
            $permissions['view-reports']->id,
        ]);

        // Ensure seeded admin user is in a department and role
        $admin = User::where('email', 'admin@agenda2063.africa')->first();
        if ($admin) {
            $admin->department_id = $departments['planning-monitoring']->id ?? $departments->first()->id;
            $admin->is_admin = true;
            $admin->save();

            $admin->roles()->sync([$roles['super-admin']->id]);
        }
    }
}
