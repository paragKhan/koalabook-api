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

        // create roles
        foreach ($roles as $role) {
            Role::create(['name' => $role, 'guard_name' => 'sanctum']);
        }
    }
}
