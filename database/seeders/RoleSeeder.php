<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        // Create admin with all permissions
        $admin = Role::create(['name' => 'admin']);
        $admin->givePermissionTo(Permission::all());

        // Create moderator with all permissions except destroy
        $moderator = Role::create(['name' => 'modarator']);
        $moderator->givePermissionTo(
            Permission::where('name', 'not like', 'destroy.%')->get()
        );

        // Create user with only view permissions
        $user = Role::create(['name' => 'user']);
        $user->givePermissionTo(
            Permission::where('name', 'like', 'view.%')->get()
        );
    }
}
