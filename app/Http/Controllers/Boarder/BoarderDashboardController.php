<?php

namespace App\Http\Controllers\Boarder;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\Boarder;
use App\Models\Room;
use Carbon\Carbon;
use App\Models\Transaction;

class BoarderDashboardController extends Controller
{
    //
    public function index()
    {
        $user = auth()->user();

        // Get boarder
        $boarder = Boarder::where('user_id', $user->id)->first();
        if (!$boarder) {
            return view('boarder.dashboard', compact('user'))->with('rent_data', null);
        }

        // Get active assignment + room
        $assignment = Assignment::with('room')
            ->where('boarder_id', $boarder->id)
            ->where('status', 'active')
            ->latest('start_date')
            ->first();

        // If no room assignment exists
        if (!$assignment) {

            $rent_data = null;

            return view('boarder.dashboard', compact('user', 'rent_data'));
        }

        $room = $assignment->room;

        // Convert start_date to Carbon
        $startDate = Carbon::parse($assignment->start_date);

        // Today's date
        $today = Carbon::today();

        // Start checking billing cycles from start_date
        $cycleStart = $startDate->copy();

        $lastPaid = null;
        $nextUnpaid = null;

        while (true) {

            // Billing month stored in DB
            $billingMonth = $cycleStart->copy()->startOfMonth();

            // Billing period end
            $cycleEnd = $cycleStart->copy()->addMonth();

            // Due date is the same as cycle end
            $dueDate = $cycleEnd->copy();

            // Check if payment exists
            $payment = Transaction::where('room_id', $room->id)
                ->where('boarder_id', $boarder->id)
                ->where('billing_month', $billingMonth)
                ->first();

            if ($payment) {

                // Save last paid billing period
                $lastPaid = [
                    'billing_period_start' => $cycleStart->toFormattedDateString(),
                    'billing_period_end' => $cycleEnd->toFormattedDateString(),
                    'due_date' => $dueDate->toFormattedDateString(),
                    'billing_month' => $billingMonth->toFormattedDateString()
                ];

                // Move to next billing cycle
                $cycleStart->addMonth();
            } else {

                // First unpaid cycle
                $nextUnpaid = [
                    'billing_period_start' => $cycleStart->toFormattedDateString(),
                    'billing_period_end' => $cycleEnd->toFormattedDateString(),
                    'due_date' => $dueDate->toFormattedDateString(),
                    'billing_month' => $billingMonth->toFormattedDateString()
                ];

                break;
            }
        }

        /*
    STATUS RULES
    */

        $status = null;
        $rentInfo = null;

        if ($nextUnpaid) {

            $dueDate = Carbon::parse($nextUnpaid['due_date']);

            // Start of upcoming window
            $upcomingWindow = $dueDate->copy()->subDays(7);

            if ($today->greaterThan($dueDate)) {

                // Rent is overdue
                $status = 'Overdue';
                $rentInfo = $nextUnpaid;
            } elseif ($today->greaterThanOrEqualTo($upcomingWindow)) {

                // Show next billing cycle 7 days before due
                $status = 'Upcoming';
                $rentInfo = $nextUnpaid;
            } else {

                // Otherwise show the last paid billing
                $status = 'Paid';
                $rentInfo = $lastPaid;
            }
        } else {

            // Everything paid
            $status = 'Paid';
            $rentInfo = $lastPaid;
        }

        $rent_data = collect([
            'room_number' => $room->number ?? null,
            'amount' => $room->monthly_rent ?? ($room->price ?? null),
            'billing_period_start' => $rentInfo['billing_period_start'] ?? null,
            'billing_period_end' => $rentInfo['billing_period_end'] ?? null,
            'due_date' => $rentInfo['due_date'] ?? null,
            'billing_month' => $rentInfo['billing_month'] ?? null,
            'status' => $status
        ]);

        // dd($rent_data);

        return view('boarder.dashboard', compact('user', 'assignment', 'room', 'rent_data'));
    }

    // Transactions
    public function transactions()
    {
        $user = auth()->user();
        $transactions = Transaction::with('staff.user')
            ->where('boarder_id', $user->boarder->id)
            ->orderBy('created_at', 'desc')
            ->get();

        // dd($transactions);

        return view('boarder.transactions', compact('user', 'transactions'));
    }

    public function sample()
    {
        $user = auth()->user();
        return view('boarder.sample', compact('user'));
    }
}
