<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\Boarder;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    /**
     * Display a read-only ledger of recent transactions.
     */
    public function index(Request $request)
    {
        $query = Transaction::with('boarder', 'staff');

        // Filter by status
        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }

        // Filter by payment method
        if ($request->has('payment_method') && $request->payment_method) {
            $query->where('payment_method', $request->payment_method);
        }

        $transactions = $query->orderBy('created_at', 'desc')->paginate(20);
        $statuses = ['pending', 'completed', 'failed'];
        $methods = ['cash', 'e_wallet'];

        return view('staff.payments.index', compact('transactions', 'statuses', 'methods'));
    }

    /**
     * Show the form for processing a new payment.
     */
    public function create(Request $request)
    {
        $boarder = null;
        if ($request->has('boarder')) {
            $boarder = Boarder::findOrFail($request->boarder);
        }

        $boarders = Boarder::where('status', 'active')->get();
        return view('staff.payments.create', compact('boarder', 'boarders'));
    }

    /**
     * Store a newly created transaction record.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'boarder_id' => 'required|exists:boarders,id',
            'amount' => 'required|numeric|min:0.01',
            'payment_method' => 'required|in:cash,e_wallet',
        ]);

        // Get the boarder's current room assignment
        $boarder = Boarder::with('assignments.room')->findOrFail($validated['boarder_id']);
        $currentAssignment = $boarder->assignments()
            ->whereNull('end_date')
            ->orWhere('end_date', '>=', now()->toDateString())
            ->first();
        
        $roomId = $currentAssignment ? $currentAssignment->room_id : null;

        // Get the staff ID from the staffs table using the authenticated user's ID
        // If no staff record exists, create one
        $staff = Staff::firstOrCreate(
            ['user_id' => Auth::id()],
            ['employment_date' => now()->toDateString(), 'status' => 'active']
        );
        $staffId = $staff->id;

        // Create transaction record
        Transaction::create([
            'boarder_id' => $validated['boarder_id'],
            'room_id' => $roomId,
            'amount' => $validated['amount'],
            'payment_method' => $validated['payment_method'],
            'status' => 'completed',
            'billing_month' => now()->format('F Y'),
            'staff_id' => $staffId,
        ]);

        return redirect()->route('staff.payments.index')
            ->with('success', 'Payment recorded successfully!');
    }

    /**
     * Display the specified transaction (read-only).
     */
    public function show(Transaction $transaction)
    {
        $transaction->load('boarder', 'staff');
        return view('staff.payments.show', compact('transaction'));
    }

    /**
     * Note: No edit, update, or delete methods for staff users.
     * Staff cannot modify or delete transaction logs.
     */
}
