<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed roles and permissions first
        $this->call(RoleAndPermissionSeeder::class);

        // Create a test staff user
        $staffUser = User::factory()->create([
            'first_name' => 'Staff',
            'last_name' => 'User',
            'email' => 'staff@example.com',
            'role' => 'staff',
        ]);
        $staffUser->assignRole('staff');

        // Create an admin user  
        $adminUser = User::factory()->create([
            'first_name' => 'Admin',
            'last_name' => 'User',
            'email' => 'admin@example.com',
            'role' => 'admin',
        ]);
        $adminUser->assignRole('admin');
    }
}
