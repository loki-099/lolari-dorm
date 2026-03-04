<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create permissions
        $permissions = [
            'manage-rooms',
            'onboard-boarder',
            'assign-room',
            'process-payment',
            'view-basic-analytics',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Create staff role
        $staffRole = Role::firstOrCreate(['name' => 'staff']);

        // Assign permissions to staff role
        $staffRole->syncPermissions($permissions);
    }
}
