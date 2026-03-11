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

        $recentTransactions = Transaction::with(['boarder', 'room', 'staff'])
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get()
            ->map(function ($transaction) {
            
                if ($transaction->status === 'completed') {
                    $transaction->display_status = 'Completed';
                } elseif ($transaction->billing_month) {
                    try {
                        $billingDate = Carbon::parse($transaction->billing_month);
                        if ($billingDate->startOfMonth() < Carbon::now('Asia/Manila')->startOfMonth()) {
                            $transaction->display_status = 'Overdue';
                        } else {
                            $transaction->display_status = 'Pending';
                        }
                    } catch (\Exception $e) {
                        // If parsing fails, default to Pending
                        $transaction->display_status = 'Pending';
                    }
                } else {
                    $transaction->display_status = 'Pending';
                }

                // Get staff name from Staff model relationship
                $transaction->staff_name = $transaction->staff?->name ?? 'N/A';

                // Format payment method for display
                $methodLabels = [
                    'cash' => 'Cash',
                    'e_wallet' => 'E-wallet'
                ];
                $transaction->method_display = $methodLabels[$transaction->method] ?? $transaction->method;

                // Format type for display
                $transaction->type_display = ucfirst($transaction->type ?? 'rent');

                // Format date in Philippine timezone
                $transaction->transaction_date = $transaction->created_at->timezone('Asia/Manila')->format('M d, Y');
                
                // Format billing month for display (already stored as "March 2026" format)
                $transaction->billing_month_display = $transaction->billing_month 
                    ? Carbon::parse($transaction->billing_month)->timezone('Asia/Manila')->format('F Y')
                    : '-';

                return $transaction;
            });

        // Get recent activities (for now, we'll create some placeholder activities based on recent transactions)
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
            'recentActivities'
        ));
    }
}
