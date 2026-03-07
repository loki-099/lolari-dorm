<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\Transaction;
use App\Models\Assignment;
use Illuminate\Http\Request;

class AnalyticsController extends Controller
{
    /**
     * Display basic analytics: daily revenue and occupancy rate.
     */
    public function index()
    {
        // Calculate occupancy rate
        $totalRooms = Room::count();
        $occupiedRooms = Room::where('status', 'occupied')->count();
        $occupancyRate = $totalRooms > 0 ? round(($occupiedRooms / $totalRooms) * 100, 2) : 0;

        // Calculate daily total revenue
        $today = now()->format('Y-m-d');
        $dailyRevenue = Transaction::whereDate('created_at', $today)
            ->where('status', 'completed')
            ->sum('amount');

        // Get pending payments count
        $pendingPayments = Transaction::where('status', 'pending')->count();

        // Get available rooms count
        $availableRooms = Room::where('status', 'available')->count();

        return response()->json([
            'daily_total_revenue' => $dailyRevenue,
            'occupancy_rate' => $occupancyRate,
            'occupied_rooms' => $occupiedRooms,
            'total_rooms' => $totalRooms,
            'pending_payments' => $pendingPayments,
            'available_rooms' => $availableRooms,
        ]);
    }
}
