<?php

namespace Database\Seeders;

use App\Models\Assignment;
use App\Models\Boarder;
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
            'role' => 'boarder',
        ]);

        $room101 =Room::create([
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

        // Create a boarder user
        $boarder = Boarder::create([
            'user_id' => $boarderUser->id,
            'home_address' => '123 Main St',
            'parent_contact' => '09876543210',
            'status' => 'active',
        ]);

        $staffUser = Staff::create([
            'user_id' => $staffUser->id,
            'employment_date' => now(),
            'status' => 'active',
        ]);

        Assignment::create([
            'boarder_id' => $boarder->id,
            'room_id' => $room101->id,
            'start_date' => now(),
            'end_date' => now()->addYear(),
        ]);

        Transaction::create([
            'room_id' => $room101->id,
            'boarder_id' => $boarder->id,
            'staff_id' => $staffUser->id,
            'amount' => 5000,
            'type' => 'rent',
            'method' => 'cash',
            'status' => 'completed',
            'billing_month' => now()->startOfMonth(),
        ]);
    }
}
