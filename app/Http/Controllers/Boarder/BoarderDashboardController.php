<?php

namespace App\Http\Controllers\Boarder;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\Boarder;
use App\Models\UtilityBill;
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
        $today = Carbon::today();
        $currentOccupancy = $room->assignments()->where('status', 'active')->count();

        // Fetch utility bills for the room
        $utilityBills = UtilityBill::where('room_id', $room->id)
            ->orderBy('billing_month', 'desc')
            ->get()
            ->groupBy('type');

        // Ensure all bill types exist
        $utilityBills = collect([
            'electricity' => $utilityBills->get('electricity', collect()),
            'water' => $utilityBills->get('water', collect()),
            'internet' => $utilityBills->get('internet', collect()),
        ]);

        $billingCycleStart = Carbon::parse($assignment->start_date)->startOfDay();
        $lastPaid = null;
        $nextUnpaid = null;

        // Determine rent state per assignment anniversary cycle using completed rent transactions only.
        while (true) {
            $billingPeriodStart = $billingCycleStart->copy();
            $billingPeriodEnd = $billingCycleStart->copy()->addMonth();
            $dueDate = $billingPeriodEnd->copy();
            $billingMonthKey = $billingPeriodStart->copy()->startOfMonth();

            $isPaid = Transaction::where('room_id', $room->id)
                ->where('type', 'rent')
                ->where('status', 'completed')
                ->whereDate('billing_month', $billingMonthKey->toDateString())
                ->whereHas('boarder.assignments', function ($query) use ($room) {
                    $query->where('room_id', $room->id)
                          ->where('status', 'active');
                })
                ->exists();

            $periodPayload = [
                'billing_period_start' => $billingPeriodStart->toFormattedDateString(),
                'billing_period_end' => $billingPeriodEnd->toFormattedDateString(),
                'due_date' => $dueDate->toFormattedDateString(),
                'billing_month' => $billingPeriodStart->format('M d, Y') . ' - ' . $billingPeriodEnd->format('M d, Y'),
            ];

            if ($isPaid) {
                $lastPaid = $periodPayload;
                $billingCycleStart->addMonth();
                continue;
            }

            $nextUnpaid = $periodPayload;
            break;
        }

        $status = 'Paid';
        $rentInfo = $lastPaid ?? $nextUnpaid;

        if ($nextUnpaid) {
            $nextUnpaidDueDate = Carbon::parse($nextUnpaid['due_date']);
            $upcomingWindow = $nextUnpaidDueDate->copy()->subDays(7);

            if ($today->greaterThan($nextUnpaidDueDate)) {
                $status = 'Overdue';
                $rentInfo = $nextUnpaid;
            } elseif ($today->greaterThanOrEqualTo($upcomingWindow)) {
                $status = 'Upcoming';
                $rentInfo = $nextUnpaid;
            } elseif ($lastPaid) {
                $status = 'Paid';
                $rentInfo = $lastPaid;
            } else {
                $status = 'Upcoming';
                $rentInfo = $nextUnpaid;
            }
        }

        $rent_data = collect([
            'room_number' => $room->number ?? null,
            'amount' => $room->monthly_rent ?? null,
            'billing_period_start' => $rentInfo['billing_period_start'] ?? null,
            'billing_period_end' => $rentInfo['billing_period_end'] ?? null,
            'due_date' => $rentInfo['due_date'] ?? null,
            'billing_month' => $rentInfo['billing_month'] ?? null,
            'status' => $status,
        ]);

        // dd($rent_data);

        return view('boarder.dashboard', compact('user', 'assignment', 'room', 'rent_data', 'currentOccupancy', 'utilityBills'));
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
