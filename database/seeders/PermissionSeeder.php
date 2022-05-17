<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // Role
        Permission::create(['name' => 'Create-Role', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Read-Roles', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Update-Role', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Delete-Role', 'guard_name' => 'admin']);

        // Permissions
        Permission::create(['name' => 'Read-Permissions', 'guard_name' => 'admin']);

        // Admin
        Permission::create(['name' => 'Create-Admin', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Read-Admin', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Update-Admin', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Delete-Admin', 'guard_name' => 'admin']);

        // User
        Permission::create(['name' => 'Read-User', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Delete-User', 'guard_name' => 'admin']);

        // University
        Permission::create(['name' => 'Create-University', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Read-University', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Update-University', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Delete-University', 'guard_name' => 'admin']);

        // Faculities
        Permission::create(['name' => 'Create-Faculities', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Read-Faculities', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Update-Faculities', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Delete-Faculities', 'guard_name' => 'admin']);

        // Departments
        Permission::create(['name' => 'Create-Departments', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Read-Departments', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Update-Departments', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Delete-Departments', 'guard_name' => 'admin']);

        //User
        Permission::create(['name' => 'Read-University', 'guard_name' => 'user']);
        Permission::create(['name' => 'Read-Faculities', 'guard_name' => 'user']);
        Permission::create(['name' => 'Read-Departments', 'guard_name' => 'user']);
    }
}
