<?php

namespace Database\Seeders;

use App\Models\Room;
use App\Models\Staff;
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

        // Create staff record in staffs table
        Staff::create([
            'user_id' => $staffUser->id,
            'employment_date' => now()->toDateString(),
            'status' => 'active',
        ]);

        // Create an admin user  
        $adminUser = User::factory()->create([
            'first_name' => 'Admin',
            'last_name' => 'User',
            'email' => 'admin@example.com',
            'role' => 'admin',
        ]);
        $adminUser->assignRole('admin');

        // Create staff record in staffs table for admin (if admin needs to record transactions)
        Staff::create([
            'user_id' => $adminUser->id,
            'employment_date' => now()->toDateString(),
            'status' => 'active',
        ]);

        $boarderUser = User::factory()->create([
            'first_name' => 'Juan',
            'last_name' => 'Tamad',
            'email' => 'boarder@example.com',
            'role' => 'user',
        ]);

        Room::create([
            'number' => '101',
            'capacity' => '4',
            'monthly_rent' => '5000',
            'status' => 'available'
        ]);
        Room::create([
            'number' => '102',
            'capacity' => '4',
            'monthly_rent' => '5000',
            'status' => 'available'
        ]);
        Room::create([
            'number' => '103',
            'capacity' => '4',
            'monthly_rent' => '5000',
            'status' => 'available'
        ]);
    }
}
