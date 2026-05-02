<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Boarder;
use App\Models\Expense;
use App\Models\Room;
use App\Models\Transaction;
use App\Models\UtilityBill;
use Carbon\Carbon;

class ReportsController extends Controller
{
    public function index()
    {
        $today = Carbon::now('Asia/Manila');

        $completedTransactions = Transaction::where('status', 'completed');
        $pendingTransactions = Transaction::where('status', 'pending');
        $failedTransactions = Transaction::where('status', 'failed');

        $totalRevenue = $completedTransactions->sum('amount');
        $completedCount = $completedTransactions->count();
        $pendingCount = $pendingTransactions->count();
        $pendingAmount = $pendingTransactions->sum('amount');
        $failedCount = $failedTransactions->count();
        $failedAmount = $failedTransactions->sum('amount');

        $totalExpenses = Expense::sum('amount');
        $expenseCount = Expense::count();
        $averageExpense = $expenseCount > 0 ? round($totalExpenses / $expenseCount, 2) : 0;

        $outstandingReceivables = $pendingAmount;
        $overdueReceivables = Transaction::where('status', 'pending')
            ->whereDate('billing_month', '<', $today->startOfMonth())
            ->sum('amount');

        $utilityOutstanding = UtilityBill::where('status', 'unpaid')->sum('amount');
        $utilityOverdue = UtilityBill::where('status', 'unpaid')
            ->whereDate('due_date', '<', $today)
            ->sum('amount');
        $utilityByType = UtilityBill::selectRaw('type, count(*) as count, sum(amount) as total')
            ->groupBy('type')
            ->get()
            ->keyBy('type');

        $paymentMethods = Transaction::selectRaw('payment_method, count(*) as count, sum(amount) as total')
            ->groupBy('payment_method')
            ->get()
            ->keyBy('payment_method');

        $expenseByType = Expense::selectRaw('expense_type, count(*) as count, sum(amount) as total')
            ->groupBy('expense_type')
            ->orderByDesc('total')
            ->get();

        $topRooms = Transaction::where('status', 'completed')
            ->selectRaw('room_id, count(*) as transactions_count, sum(amount) as total_amount')
            ->groupBy('room_id')
            ->orderByDesc('total_amount')
            ->limit(5)
            ->get();

        $roomNumbers = Room::whereIn('id', $topRooms->pluck('room_id')->all())
            ->pluck('number', 'id');

        $monthlySummary = collect();
        for ($i = 11; $i >= 0; $i--) {
            $month = $today->copy()->startOfMonth()->subMonths($i);
            $monthlySummary->push([
                'label' => $month->format('M Y'),
                'key' => $month->format('Y-m'),
                'revenue' => 0,
                'expenses' => 0,
            ]);
        }

        $rawRevenue = Transaction::where('status', 'completed')
            ->where('created_at', '>=', $today->copy()->subMonths(11)->startOfMonth())
            ->selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, SUM(amount) as total')
            ->groupByRaw('YEAR(created_at), MONTH(created_at)')
            ->get()
            ->keyBy(fn ($row) => $row->year . '-' . sprintf('%02d', $row->month));

        $rawExpenses = Expense::where('expense_date', '>=', $today->copy()->subMonths(11)->startOfMonth())
            ->selectRaw('YEAR(expense_date) as year, MONTH(expense_date) as month, SUM(amount) as total')
            ->groupByRaw('YEAR(expense_date), MONTH(expense_date)')
            ->get()
            ->keyBy(fn ($row) => $row->year . '-' . sprintf('%02d', $row->month));

        $monthlySummary = $monthlySummary->map(function ($item) use ($rawRevenue, $rawExpenses) {
            $key = $item['key'];
            $item['revenue'] = $rawRevenue->has($key) ? (float) $rawRevenue[$key]->total : 0;
            $item['expenses'] = $rawExpenses->has($key) ? (float) $rawExpenses[$key]->total : 0;
            return $item;
        });

        $latestTransactions = Transaction::with(['boarder.user', 'room', 'staff'])
            ->orderByDesc('created_at')
            ->limit(10)
            ->get();

        $latestExpenses = Expense::with(['room', 'staff'])
            ->orderByDesc('expense_date')
            ->limit(10)
            ->get();

        $totalBoarders = Boarder::count();

        return view('admin.reports.index', compact(
            'totalRevenue',
            'completedCount',
            'pendingCount',
            'pendingAmount',
            'failedCount',
            'failedAmount',
            'totalExpenses',
            'expenseCount',
            'averageExpense',
            'outstandingReceivables',
            'overdueReceivables',
            'utilityOutstanding',
            'utilityOverdue',
            'utilityByType',
            'paymentMethods',
            'expenseByType',
            'topRooms',
            'roomNumbers',
            'monthlySummary',
            'latestTransactions',
            'latestExpenses',
            'totalBoarders'
        ));
    }
}
