<?php

namespace Database\Seeders;

use App\Models\Assignment;
use App\Models\Boarder;
use App\Models\BoarderActivity;
use App\Models\Expense;
use App\Models\Room;
use App\Models\Staff;
use App\Models\Transaction;
use App\Models\UtilityBill;
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
        // $this->call(RoleAndPermissionSeeder::class);

        // Create admin user
        $adminUser = User::factory()->create([
            'first_name' => 'Admin',
            'last_name' => 'User',
            'email' => 'admin@example.com',
            'role' => 'admin',
            'contact_number' => '09051234567',
        ]);

        // Create multiple staff members
        $staffUsers = collect([
            ['first_name' => 'Mara', 'last_name' => 'Santos', 'email' => 'mara@example.com', 'contact_number' => '09171234567'],
            ['first_name' => 'Carlos', 'last_name' => 'Reyes', 'email' => 'carlos@example.com', 'contact_number' => '09281234567'],
            ['first_name' => 'Rosa', 'last_name' => 'Garcia', 'email' => 'rosa@example.com', 'contact_number' => '09361234567'],
        ])->map(fn ($staff) => User::factory()->create(array_merge($staff, ['role' => 'staff'])));

        // Create staff records
        $staffMembers = $staffUsers->map(fn ($user) => Staff::create([
            'user_id' => $user->id,
            'employment_date' => now()->subMonths(rand(2, 12)),
            'status' => 'active',
        ]));

        // Create 12 rooms with realistic dorm setup
        $rooms = collect([
            // Ground Floor
            ['number' => '101', 'capacity' => 4, 'monthly_rent' => 5000, 'status' => 'occupied'],
            ['number' => '102', 'capacity' => 4, 'monthly_rent' => 5000, 'status' => 'occupied'],
            ['number' => '103', 'capacity' => 2, 'monthly_rent' => 3000, 'status' => 'occupied'],
            ['number' => '104', 'capacity' => 2, 'monthly_rent' => 3000, 'status' => 'available'],
            // Second Floor
            ['number' => '201', 'capacity' => 4, 'monthly_rent' => 5500, 'status' => 'occupied'],
            ['number' => '202', 'capacity' => 4, 'monthly_rent' => 5500, 'status' => 'occupied'],
            ['number' => '203', 'capacity' => 2, 'monthly_rent' => 3500, 'status' => 'occupied'],
            ['number' => '204', 'capacity' => 2, 'monthly_rent' => 3500, 'status' => 'maintenance'],
            // Third Floor
            ['number' => '301', 'capacity' => 4, 'monthly_rent' => 6000, 'status' => 'occupied'],
            ['number' => '302', 'capacity' => 4, 'monthly_rent' => 6000, 'status' => 'occupied'],
            ['number' => '303', 'capacity' => 3, 'monthly_rent' => 4500, 'status' => 'available'],
            ['number' => '304', 'capacity' => 2, 'monthly_rent' => 4000, 'status' => 'occupied'],
        ])->map(fn ($room) => Room::create(array_merge($room, [
            'created_at' => \Carbon\Carbon::createFromDate(2026, 1, rand(1, 15)),
            'updated_at' => \Carbon\Carbon::createFromDate(2026, 1, rand(1, 15)),
        ])));

        // Create 15 boarders with realistic data
        $boarderUsers = collect([
            ['first_name' => 'Juan', 'last_name' => 'Tamad', 'email' => 'juan.tamad@example.com', 'contact_number' => '09091234567'],
            ['first_name' => 'Maria', 'last_name' => 'Cruz', 'email' => 'maria.cruz@example.com', 'contact_number' => '09101234567'],
            ['first_name' => 'Jose', 'last_name' => 'Rizal', 'email' => 'jose.rizal@example.com', 'contact_number' => '09111234567'],
            ['first_name' => 'Ana', 'last_name' => 'Santos', 'email' => 'ana.santos@example.com', 'contact_number' => '09121234567'],
            ['first_name' => 'Pedro', 'last_name' => 'Fernandez', 'email' => 'pedro.fern@example.com', 'contact_number' => '09131234567'],
            ['first_name' => 'Carmen', 'last_name' => 'Luna', 'email' => 'carmen.luna@example.com', 'contact_number' => '09141234567'],
            ['first_name' => 'Miguel', 'last_name' => 'Reyes', 'email' => 'miguel.reyes@example.com', 'contact_number' => '09151234567'],
            ['first_name' => 'Isabella', 'last_name' => 'Gonzales', 'email' => 'isabella.gon@example.com', 'contact_number' => '09161234567'],
            ['first_name' => 'Ramon', 'last_name' => 'Torres', 'email' => 'ramon.torres@example.com', 'contact_number' => '09171234567'],
            ['first_name' => 'Lucia', 'last_name' => 'Morales', 'email' => 'lucia.morales@example.com', 'contact_number' => '09181234567'],
            ['first_name' => 'Diego', 'last_name' => 'Villanueva', 'email' => 'diego.villa@example.com', 'contact_number' => '09191234567'],
            ['first_name' => 'Sofia', 'last_name' => 'Mendoza', 'email' => 'sofia.mendoza@example.com', 'contact_number' => '09201234567'],
            ['first_name' => 'Luis', 'last_name' => 'Cabrera', 'email' => 'luis.cabrera@example.com', 'contact_number' => '09211234567'],
            ['first_name' => 'Elena', 'last_name' => 'Flores', 'email' => 'elena.flores@example.com', 'contact_number' => '09221234567'],
            ['first_name' => 'Antonio', 'last_name' => 'Rojas', 'email' => 'antonio.rojas@example.com', 'contact_number' => '09231234567'],
        ])->map(fn ($boarder) => User::factory()->create(array_merge($boarder, ['role' => 'boarder'])));

        // Create boarder profiles
        $boarders = $boarderUsers->map(fn ($user, $idx) => Boarder::create([
            'user_id' => $user->id,
            'home_address' => collect([
                '123 Main Street, Quezon City',
                '456 Rizal Avenue, Manila',
                '789 Espana Boulevard, Sampaloc',
                '321 Taft Avenue, Malate',
                '654 EDSA, Makati',
                '987 Commonwealth Avenue, Diliman',
            ])->random(),
            'parent_contact' => '09' . rand(10, 99) . rand(1000000, 9999999),
            'status' => 'active',
            'qrcode_value' => \Illuminate\Support\Str::random(10),
        ]));

        // Create assignments - link boarders to rooms
        $occupiedRoomIndices = [0, 1, 2, 4, 5, 6, 8, 9, 11];
        $assignments = [];
        foreach ($boarders as $idx => $boarder) {
            if ($idx < count($occupiedRoomIndices)) {
                $roomIdx = $occupiedRoomIndices[$idx];
                $startDate = \Carbon\Carbon::createFromDate(2026, rand(1, 4), rand(1, 28));
                $assignments[] = Assignment::create([
                    'boarder_id' => $boarder->id,
                    'room_id' => $rooms[$roomIdx]->id,
                    'start_date' => $startDate,
                    'end_date' => $startDate->copy()->addYear(),
                    'status' => 'active',
                    'created_at' => $startDate,
                    'updated_at' => $startDate,
                ]);
            }
        }

        // Create transactions - simulate payment history from assignment start date to May 2026
        foreach ($assignments as $assignment) {
            $baseRent = $assignment->room->monthly_rent;
            $boarder = $assignment->boarder;
            $staff = $staffMembers->random();
            $assignmentStartDate = $assignment->start_date;

            // Calculate months from assignment start to May 2026
            $currentMonth = \Carbon\Carbon::createFromDate(2026, 5, 1)->startOfMonth();
            $loopMonth = $assignmentStartDate->copy()->startOfMonth();

            // Create transactions for each month from assignment start to current month
            while ($loopMonth <= $currentMonth) {
                $paymentMethod = collect(['cash', 'bank_transfer', 'check', 'online'])->random();
                
                // All transactions are completed
                $transactionDate = $loopMonth->copy()->addDays(rand(1, 28))->setTime(rand(8, 18), rand(0, 59));
                Transaction::create([
                    'room_id' => $assignment->room_id,
                    'boarder_id' => $boarder->id,
                    'staff_id' => $staff->id,
                    'amount' => $baseRent,
                    'type' => 'rent',
                    'payment_method' => $paymentMethod,
                    'billing_month' => $loopMonth,
                    'status' => 'completed',
                    'created_at' => $transactionDate,
                    'updated_at' => $transactionDate,
                ]);
                
                $loopMonth->addMonth();
            }
        }

        // Create utility bills for each occupied room
        $utilityTypes = ['electricity', 'water', 'internet'];
        $billAmounts = [
            'electricity' => [1000, 1200, 1500, 2000],
            'water' => [300, 400, 500],
            'internet' => [800, 1000, 1200],
        ];

        foreach ($rooms->where('status', '!=', 'available') as $room) {
            foreach ($utilityTypes as $type) {
                $baseAmount = collect($billAmounts[$type])->random();

                // Current month bill
                $currentBillDate = now()->startOfMonth()->setTime(rand(8, 18), rand(0, 59));
                UtilityBill::create([
                    'room_id' => $room->id,
                    'type' => $type,
                    'amount' => $baseAmount + rand(-100, 200),
                    'billing_month' => now()->startOfMonth(),
                    'due_date' => now()->endOfMonth(),
                    'status' => collect(['paid', 'unpaid'])->random(),
                    'created_at' => $currentBillDate,
                    'updated_at' => $currentBillDate,
                ]);

                // Previous month bill (all paid)
                $prevBillDate = now()->subMonth()->startOfMonth()->setTime(rand(8, 18), rand(0, 59));
                UtilityBill::create([
                    'room_id' => $room->id,
                    'type' => $type,
                    'amount' => $baseAmount + rand(-100, 200),
                    'billing_month' => now()->subMonth()->startOfMonth(),
                    'due_date' => now()->subMonth()->endOfMonth(),
                    'status' => 'paid',
                    'created_at' => $prevBillDate,
                    'updated_at' => $prevBillDate,
                ]);
            }
        }

        // Create maintenance and operational expenses
        $expenseDescriptions = [
            'Repair of broken door lock',
            'Electrical wiring maintenance',
            'Plumbing repair - leaking faucet',
            'Room paint and maintenance',
            'HVAC system servicing',
            'Window repair and replacement',
            'Flooring repair',
            'Fire extinguisher refill',
            'Cleaning supplies',
            'Light bulb replacement',
        ];

        for ($i = 0; $i < 15; $i++) {
            $expenseDate = \Carbon\Carbon::createFromDate(2026, rand(1, 5), rand(1, 28))->setTime(rand(8, 18), rand(0, 59));
            Expense::create([
                'room_id' => $rooms->random()->id,
                'staff_id' => $staffMembers->random()->id,
                'expense_type' => collect(['maintenance', 'others'])->random(),
                'description' => collect($expenseDescriptions)->random(),
                'expense_date' => $expenseDate->format('Y-m-d'),
                'amount' => rand(500, 3000),
                'created_at' => $expenseDate,
                'updated_at' => $expenseDate,
            ]);
        }

        // Create boarder activity records - tracking building access (entry/exit)
        // Activities represent when boarders enter or leave the building
        foreach ($boarders as $boarder) {
            // Find the assignment for this boarder to get start date
            $assignment = collect($assignments)->first(fn($a) => $a->boarder_id === $boarder->id);
            
            if ($assignment) {
                $assignmentStartDate = $assignment->start_date;
                $endDate = now();
                
                // Create 15-25 access records per boarder from assignment start to now
                $activities = [];
                for ($i = 0; $i < rand(15, 25); $i++) {
                    // Random date between assignment start and now
                    $daysRange = $assignmentStartDate->diffInDays($endDate);
                    $randomDate = $assignmentStartDate->copy()
                        ->addDays(rand(0, $daysRange))
                        ->setTime(rand(6, 22), rand(0, 59)); // Logical times between 6 AM and 10 PM
                    
                    $activity = collect(['entry', 'exit'])->random();
                    
                    $activities[] = [
                        'boarder_id' => $boarder->id,
                        'activity_name' => $activity,
                        'activity_date' => $randomDate->format('Y-m-d'),
                        'activity_reason' => $activity === 'entry' ? 'Entered building' : 'Left building',
                        'created_at' => $randomDate,
                        'updated_at' => $randomDate,
                    ];
                }
                
                // Sort activities by created_at to make them chronological
                usort($activities, fn($a, $b) => $a['created_at']->timestamp <=> $b['created_at']->timestamp);
                
                // Create them in order
                foreach ($activities as $activityData) {
                    BoarderActivity::create($activityData);
                }
            }
        }
    }
}
