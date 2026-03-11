<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\Boarder;
use App\Models\Transaction;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    /**
     * Display the staff reports page with analytics and summaries.
     */
    public function index()
    {
        // Revenue calculations
        $totalRevenue = Transaction::where('status', 'completed')->sum('amount');
        $completedPayments = Transaction::where('status', 'completed')->count();
        $completedAmount = Transaction::where('status', 'completed')->sum('amount');
        $pendingPayments = Transaction::where('status', 'pending')->count();
        $pendingAmount = Transaction::where('status', 'pending')->sum('amount');
        $failedPayments = Transaction::where('status', 'failed')->count();
        $failedAmount = Transaction::where('status', 'failed')->sum('amount');

        // Room calculations
        $totalRooms = Room::count();
        $occupiedRooms = Room::where('status', 'occupied')->count();
        $availableRooms = Room::where('status', 'available')->count();
        $maintenanceRooms = Room::where('status', 'maintenance')->count();

        $occupancyPercentage = $totalRooms > 0 ? round(($occupiedRooms / $totalRooms) * 100, 2) : 0;
        $availablePercentage = $totalRooms > 0 ? round(($availableRooms / $totalRooms) * 100, 2) : 0;
        $maintenancePercentage = $totalRooms > 0 ? round(($maintenanceRooms / $totalRooms) * 100, 2) : 0;

        // Boarder calculations
        $totalBoarders = Boarder::count();
        $activeBoarders = Boarder::where('status', 'active')->count();
        $inactiveBoarders = Boarder::where('status', 'inactive')->count();
        $suspendedBoarders = Boarder::where('status', 'suspended')->count();

        $activeBoardersPercentage = $totalBoarders > 0 ? round(($activeBoarders / $totalBoarders) * 100, 2) : 0;
        $inactiveBoardersPercentage = $totalBoarders > 0 ? round(($inactiveBoarders / $totalBoarders) * 100, 2) : 0;
        $suspendedBoardersPercentage = $totalBoarders > 0 ? round(($suspendedBoarders / $totalBoarders) * 100, 2) : 0;

        // Transaction totals
        $totalTransactions = Transaction::count();

        // Payment methods breakdown
        $methodCounts = [
            'cash' => Transaction::where('payment_method', 'cash')->count(),
            'e_wallet' => Transaction::where('payment_method', 'e_wallet')->count(),
        ];

        $methodAmounts = [
            'cash' => Transaction::where('payment_method', 'cash')->sum('amount'),
            'e_wallet' => Transaction::where('payment_method', 'e_wallet')->sum('amount'),
        ];

        return view('staff.reports.index', compact(
            'totalRevenue',
            'completedPayments',
            'completedAmount',
            'pendingPayments',
            'pendingAmount',
            'failedPayments',
            'failedAmount',
            'totalRooms',
            'occupiedRooms',
            'availableRooms',
            'maintenanceRooms',
            'occupancyPercentage',
            'availablePercentage',
            'maintenancePercentage',
            'totalBoarders',
            'activeBoarders',
            'inactiveBoarders',
            'suspendedBoarders',
            'activeBoardersPercentage',
            'inactiveBoardersPercentage',
            'suspendedBoardersPercentage',
            'totalTransactions',
            'methodCounts',
            'methodAmounts'
        ));
    }
}
