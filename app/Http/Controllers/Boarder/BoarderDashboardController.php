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
        $boarder = Boarder::where('user_id', $user->id)->first();
        $assignment = Assignment::with('room')->where('boarder_id', $boarder->id)->first();

        if (!$assignment) {
            return view('boarder.dashboard', compact('user'));
        }

        $room = $assignment->room;

        $startDate = Carbon::parse($assignment->start_date);
        $today = Carbon::today();

        $billingStart = $startDate->copy();
        $lastPaidPeriod = null;
        $firstUnpaidPeriod = null;

        // Loop through each billing cycle until we reach a future unpaid period
        while ($billingStart->lessThanOrEqualTo($today)) {
            $billingMonth = $billingStart->copy()->startOfMonth();

            $payment = Transaction::where('room_id', $room->id)
                ->where('billing_month', $billingMonth)
                ->first();

            $billingEnd = $billingStart->copy()->addMonth()->subDay();
            $dueDate = $billingStart->copy()->addMonth();

            if ($payment) {
                $lastPaidPeriod = [
                    'billing_period_start' => $billingStart->toFormattedDateString(),
                    'billing_period_end' => $billingEnd->toFormattedDateString(),
                    'due_date' => $dueDate->toFormattedDateString(),
                    'billing_month' => $billingMonth->toFormattedDateString(),
                ];
            } else {
                $firstUnpaidPeriod = [
                    'billing_period_start' => $billingStart->toFormattedDateString(),
                    'billing_period_end' => $billingEnd->toFormattedDateString(),
                    'due_date' => $dueDate->toFormattedDateString(),
                    'billing_month' => $billingMonth->toFormattedDateString(),
                ];
                break; // first unpaid cycle found
            }

            $billingStart->addMonth();
        }

        // -----------------------------
        // DETERMINE STATUS AND DATA TO SHOW
        // -----------------------------
        $status = 'Paid';
        $rentInfo = $lastPaidPeriod ?? [];

        if ($firstUnpaidPeriod) {
            $upcomingWindowStart = Carbon::parse($firstUnpaidPeriod['due_date'])->subDays(7);
            if ($today->greaterThanOrEqualTo($upcomingWindowStart) && $today->lessThanOrEqualTo($firstUnpaidPeriod['due_date'])) {
                // 7 days before due date → show upcoming
                $status = 'Upcoming';
                $rentInfo = $firstUnpaidPeriod;
            } elseif ($today->greaterThan($firstUnpaidPeriod['due_date'])) {
                // overdue
                $status = 'Overdue';
                $rentInfo = $firstUnpaidPeriod;
            }
        }

        // Include amount and room number
        $rent_data = collect(array_merge($rentInfo, [
            'room_number' => $room->room_number,
            'amount' => $room->monthly_rent,
            'status' => $status,
        ]));

        return view('boarder.dashboard', compact('user', 'rent_data'));
    }

    public function sample()
    {
        $user = auth()->user();
        return view('boarder.sample', compact('user'));
    }
}
