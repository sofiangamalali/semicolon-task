<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            // User permissions
            'view_users',
            'create_users',
            'update_users',
            'delete_users',
            'assign_users_to_groups',
            
            // Group permissions
            'view_groups',
            'create_groups',
            'update_groups',
            'delete_groups',
            'assign_permissions_to_groups',
            
            // Permission permissions
            'view_permissions',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission
            ]);
        }
    }
}