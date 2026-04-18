<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\Boarder;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display the admin dashboard with comprehensive stats.
     */
    public function index()
    {
        // Calculate occupancy rate
        $totalRooms = Room::count();
        $occupiedRooms = Room::where('status', 'occupied')->count();
        $occupancyRate = $totalRooms > 0 ? round(($occupiedRooms / $totalRooms) * 100, 2) : 0;

        // Get available rooms count
        $availableRooms = Room::where('status', 'available')->count();

        // Get payment stats
        $pendingPayments = Transaction::where('status', 'pending')->count();
        $completedPayments = Transaction::where('status', 'completed')->count();

        // Get total revenue (sum of all completed transactions)
        $totalRevenue = Transaction::where('status', 'completed')->sum('amount');

        // Get boarder stats
        $totalBoarders = Boarder::count();

        // Get new boarders this month
        $newBoardersThisMonth = Boarder::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->count();

        // ── Monthly revenue for the last 12 months (for the chart) ──────────────
        // Build an ordered list of the last 12 months (oldest → newest)
        $monthlyRevenue = collect();
        for ($i = 11; $i >= 0; $i--) {
            $month = Carbon::now('Asia/Manila')->startOfMonth()->subMonths($i);
            $monthlyRevenue->push([
                'label'   => $month->format('M Y'),       // e.g. "Apr 2025"
                'short'   => $month->format('M'),          // e.g. "Apr"  – used on the chart x-axis
                'year'    => (int) $month->format('Y'),
                'month'   => (int) $month->format('n'),
                'revenue' => 0,                            // filled below
            ]);
        }

        // Fetch completed transaction totals grouped by year+month
        $rawRevenue = Transaction::where('status', 'completed')
            ->where('created_at', '>=', Carbon::now('Asia/Manila')->subMonths(11)->startOfMonth())
            ->selectRaw("YEAR(created_at) as yr, MONTH(created_at) as mo, SUM(amount) as total")
            ->groupByRaw("YEAR(created_at), MONTH(created_at)")
            ->get()
            ->keyBy(fn ($r) => $r->yr . '-' . $r->mo);   // key: "2025-4"

        // Merge real data into the skeleton
        $monthlyRevenue = $monthlyRevenue->map(function ($item) use ($rawRevenue) {
            $key = $item['year'] . '-' . $item['month'];
            $item['revenue'] = $rawRevenue->has($key)
                ? (float) $rawRevenue[$key]->total
                : 0;
            return $item;
        });

        // Get recent transactions with relationships (Philippine timezone)
        $recentTransactions = Transaction::with(['boarder', 'room', 'staff'])
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get()
            ->map(function ($transaction) {
                // Determine status: overdue if billing_month is in the past and not completed
                if ($transaction->status === 'completed') {
                    $transaction->display_status = 'Completed';
                } elseif ($transaction->billing_month < Carbon::now('Asia/Manila')->startOfMonth()) {
                    $transaction->display_status = 'Overdue';
                } else {
                    $transaction->display_status = 'Pending';
                }

                // Get staff name from Staff model relationship
                $transaction->staff_name = $transaction->staff?->name ?? 'N/A';

                // Format payment method for display
                $methodLabels = [
                    'cash'          => 'Cash',
                    'bank_transfer' => 'Bank Transfer',
                    'check'         => 'Check',
                    'online'        => 'G-Cash/PayMaya',
                ];
                $transaction->method_display = $methodLabels[$transaction->method] ?? $transaction->method;

                // Format type for display
                $transaction->type_display = ucfirst($transaction->type ?? 'rent');

                // Format date in Philippine timezone
                $transaction->transaction_date = $transaction->created_at
                    ->timezone('Asia/Manila')
                    ->format('M d, Y');

                // Format billing month for display
                $transaction->billing_month_display = Carbon::parse($transaction->billing_month)
                    ->timezone('Asia/Manila')
                    ->format('F Y');

                return $transaction;
            });

        // Get recent activities (placeholder for future implementation)
        $recentActivities = collect([]);

        return view('admin.dashboard', compact(
            'occupancyRate',
            'occupiedRooms',
            'totalRooms',
            'availableRooms',
            'pendingPayments',
            'completedPayments',
            'totalRevenue',
            'totalBoarders',
            'newBoardersThisMonth',
            'recentTransactions',
            'recentActivities',
            'monthlyRevenue',          // ← new
        ));
    }
}