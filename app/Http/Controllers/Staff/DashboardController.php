<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\Transaction;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display the staff dashboard with stat cards and action buttons.
     */
    public function index()
    {
        // Calculate occupancy rate
        $totalRooms = Room::count();
        $occupiedRooms = Room::where('status', 'occupied')->count();
        $occupancyRate = $totalRooms > 0 ? round(($occupiedRooms / $totalRooms) * 100, 2) : 0;

        // Get pending payments count
        $pendingPayments = Transaction::where('status', 'pending')->count();

        // Get available rooms count
        $availableRooms = Room::where('status', 'available')->count();

        // Get recent transactions
        $recentTransactions = Transaction::with('boarder')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        return view('staff.dashboard', compact(
            'occupancyRate',
            'pendingPayments',
            'availableRooms',
            'occupiedRooms',
            'totalRooms',
            'recentTransactions'
        ));
    }
}
