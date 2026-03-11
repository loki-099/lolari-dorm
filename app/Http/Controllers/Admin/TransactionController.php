<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\Boarder;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the transactions.
     */
    public function index(Request $request)
    {
        $query = Transaction::with(['boarder.user', 'staff']);

        // Filter by status
        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }

        // Filter by payment method
        if ($request->has('payment_method') && $request->payment_method) {
            $query->where('payment_method', $request->payment_method);
        }

        // Filter by boarder
        if ($request->has('boarder_id') && $request->boarder_id) {
            $query->where('boarder_id', $request->boarder_id);
        }

        // Filter by billing month
        if ($request->has('billing_month') && $request->billing_month) {
            $query->where('billing_month', $request->billing_month);
        }

        // Search by boarder name
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->whereHas('boarder.user', function ($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                  ->orWhere('last_name', 'like', "%{$search}%");
            });
        }

        $transactions = $query->orderBy('created_at', 'desc')->paginate(15);
        $statuses = ['pending', 'completed', 'failed'];
        $methods = ['cash', 'e_wallet'];
        $boarders = Boarder::with('user')->get();

        return view('admin.transactions.index', compact('transactions', 'statuses', 'methods', 'boarders'));
    }

    /**
     * Show the form for creating a new transaction.
     */
    public function create(Request $request)
    {
        $boarder = null;
        if ($request->has('boarder')) {
            $boarder = Boarder::with('user')->findOrFail($request->boarder);
        }

        $boarders = Boarder::where('status', 'active')->with('user')->get();
        return view('admin.transactions.create', compact('boarder', 'boarders'));
    }

    /**
     * Store a newly created transaction.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'boarder_id' => 'required|exists:boarders,id',
            'amount' => 'required|numeric|min:0.01',
            'payment_method' => 'required|in:cash,e_wallet',
            'status' => 'required|in:pending,completed,failed',
            'billing_month' => 'nullable|string',
        ]);

        // Get the boarder's current room assignment
        $boarder = Boarder::with('assignments.room')->findOrFail($validated['boarder_id']);
        $currentAssignment = $boarder->assignments()
            ->whereNull('end_date')
            ->orWhere('end_date', '>=', now()->toDateString())
            ->first();
        
        $roomId = $currentAssignment ? $currentAssignment->room_id : null;

        // Admin creating transaction - leave staff_id as null
        // Staff will be assigned when staff members create transactions
        $staffId = null;

        Transaction::create([
            'boarder_id' => $validated['boarder_id'],
            'room_id' => $roomId,
            'amount' => $validated['amount'],
            'payment_method' => $validated['payment_method'],
            'status' => $validated['status'],
            'billing_month' => $validated['billing_month'] ?? null,
            'staff_id' => $staffId,
        ]);

        return redirect()->route('admin.transactions.index')
            ->with('success', 'Transaction recorded successfully!');
    }

    /**
     * Display the specified transaction.
     */
    public function show(Transaction $transaction)
    {
        $transaction->load(['boarder.user', 'staff', 'room']);
        return view('admin.transactions.show', compact('transaction'));
    }

    /**
     * Show the form for editing the specified transaction.
     */
    public function edit(Transaction $transaction)
    {
        $transaction->load(['boarder.user', 'staff']);
        $boarders = Boarder::where('status', 'active')->with('user')->get();
        $statuses = ['pending', 'completed', 'failed'];
        $methods = ['cash', 'e_wallet'];

        return view('admin.transactions.edit', compact('transaction', 'boarders', 'statuses', 'methods'));
    }

    /**
     * Update the specified transaction.
     */
    public function update(Request $request, Transaction $transaction)
    {
        $validated = $request->validate([
            'boarder_id' => 'required|exists:boarders,id',
            'amount' => 'required|numeric|min:0.01',
            'payment_method' => 'required|in:cash,e_wallet',
            'status' => 'required|in:pending,completed,failed',
            'billing_month' => 'nullable|string',
        ]);

        $transaction->update($validated);

        return redirect()->route('admin.transactions.show', $transaction)
            ->with('success', 'Transaction updated successfully!');
    }

    /**
     * Remove the specified transaction.
     */
    public function destroy(Transaction $transaction)
    {
        $transaction->delete();

        return redirect()->route('admin.transactions.index')
            ->with('success', 'Transaction deleted successfully!');
    }
}

