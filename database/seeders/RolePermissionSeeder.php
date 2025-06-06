<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Permissions
        $permissions = [
            'users.view',
            'users.create',
            'users.edit',
            'users.delete',
            'users.disable-enable',

            'roles.view',
            'roles.create',
            'roles.edit',
            'roles.delete',

            //Academic Management
            'academic-management.view',

            'sysem.view',
            'sysem.create',
            'sysem.edit',
            'sysem.delete',
            'sysem.add-new-school-year',
            'sysem.edit-school-year',
            'sysem.add-new-semester',
            'sysem.edit-semester',
        ];

        foreach ($permissions as $permission) {
            Permission::updateOrCreate(['name' => $permission], ['name' => $permission]);
        }

        // Create Roles and Assign Permissions
        $admin = Role::updateOrCreate(['name' => 'superadmin'], ['name' => 'superadmin']);
        $admin->givePermissionTo($permissions);

        // Assign admin role to user with ID 1
        $user = \App\Models\User::find(1);
        $user->assignRole('superadmin');
    }
}
