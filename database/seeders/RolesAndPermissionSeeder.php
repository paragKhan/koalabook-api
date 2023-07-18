<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // define roles
        $roles = [
            'admin',
            'subscriber',
            'user'
        ];

        // define permissions based on the models
        $permissions = [
            'view-any-user',
            'view-user',
            'create-user',
            'update-user',
            'delete-user',
            'create-book',
            'view-paid-book',
            'update-book',
            'delete-book',
            'create-book-page',
            'update-book-page',
            'delete-book-page'
        ];

        // define permission groups for roles
        $role_permission_group = [
            'subscriber' => [
                'view-paid-book'
            ]
        ];

        // create roles
        foreach ($roles as $role) {
            Role::create(['name' => $role, 'guard_name' => 'sanctum']);
        }

        // create permissions
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission , 'guard_name' => 'sanctum']);
        }

        //assign permissions to roles according to role_permission_group
        foreach ($role_permission_group as $key => $value) {
            $role = Role::firstOrCreate(['name' => $key, 'guard_name' => 'sanctum']);
            $role->syncPermissions($value);
        }
    }
}
