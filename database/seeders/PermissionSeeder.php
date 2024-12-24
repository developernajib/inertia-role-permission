<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * Creates permissions for the given resources and actions:
     *
     * - user
     * - post
     * - role
     * - permission
     *
     * - view
     * - create
     * - update
     * - destroy
     *
     * @return void
     */
    public function run(): void
    {
        $resources = ['user', 'post', 'role', 'permission'];
        $actions = ['view', 'create', 'update', 'destroy'];

        // Loop through each resource and action to create the appropriate permissions
        foreach ($resources as $resource) {
            foreach ($actions as $action) {
                Permission::create([
                    'name' => $action . '.' . $resource,
                    'guard_name' => 'web'
                ]);
            }
        }

        Permission::insert([
            ['name' => 'destroy.role.permission', 'guard_name' => 'web'],
            ['name' => 'destroy.user.role', 'guard_name' => 'web'],
            ['name' => 'destroy.user.permission', 'guard_name' => 'web'],
        ]);
    }
}