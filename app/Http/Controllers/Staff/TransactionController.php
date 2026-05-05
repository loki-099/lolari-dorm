<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\Boarder;
use App\Models\Room;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class TransactionController extends Controller
{
    /**
     * Display a listing of transactions.
     */
    public function index(): View
    {
        $transactions = Transaction::with(['boarder.user', 'staff.user', 'room'])
            ->latest()
            ->paginate(15);

        return view('staff.transactions.index', compact('transactions'));
    }

    /**
     * Show the form for creating a new transaction.
     */
    public function create(): View
    {
        $boarders = Boarder::where('status', 'active')->with('user')->get();
        $rooms = Room::all();
        $staffs = Staff::with('user')->get();

        return view('staff.transactions.create', compact('boarders', 'rooms', 'staffs'));
    }

    /**
     * Store a newly created transaction.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'boarder_id' => 'required|exists:boarders,id',
            'staff_id' => 'required|exists:staffs,id',
            'room_id' => 'required|exists:rooms,id',
            'amount' => 'required|numeric|min:0.01',
            'payment_method' => 'required|in:cash,online',
            'status' => 'sometimes|in:pending,completed,cancelled',
            'billing_month' => 'required|date_format:m-d-Y',
            'type' => 'required|in:rent,utility',
            'method' => 'sometimes|string|max:50',
        ]);

        $validated['status'] = $validated['status'] ?? 'pending';
        $validated['billing_month'] = \Carbon\Carbon::createFromFormat('m-d-Y', $validated['billing_month'])->format('Y-m-d');

        Transaction::create($validated);

        return redirect()->route('staff.transactions.index')
            ->with('success', 'Transaction created successfully.');
    }

    /**
     * Display the specified transaction.
     */
    public function show(Transaction $transaction): View
    {
        $transaction->load(['boarder.user', 'staff.user', 'room']);

        return view('staff.transactions.show', compact('transaction'));
    }

    /**
     * Show the form for editing the specified transaction.
     */
    public function edit(Transaction $transaction): View
    {
        $boarders = Boarder::where('status', 'active')->with('user')->get();
        $rooms = Room::all();

        $transaction->load(['boarder', 'room', 'staff']);

        return view('staff.transactions.edit', compact('transaction', 'boarders', 'rooms'));
    }

    /**
     * Update the specified transaction.
     */
    public function update(Request $request, Transaction $transaction): RedirectResponse
    {
        $validated = $request->validate([
            'boarder_id' => 'sometimes|exists:boarders,id',
            'staff_id' => 'sometimes|exists:staffs,id',
            'room_id' => 'sometimes|exists:rooms,id',
            'amount' => 'sometimes|numeric|min:0.01',
            'payment_method' => 'sometimes|in:cash,online',
            'status' => 'sometimes|in:pending,completed,cancelled',
            'billing_month' => 'sometimes|date_format:m-d-Y',
            'type' => 'sometimes|in:rent,utility',
            'method' => 'sometimes|string|max:50',
        ]);

        if (isset($validated['billing_month'])) {
            $validated['billing_month'] = \Carbon\Carbon::createFromFormat('m-d-Y', $validated['billing_month'])->format('Y-m-d');
        }

        $transaction->update($validated);

        return redirect()->route('staff.transactions.index')
            ->with('success', 'Transaction updated successfully.');
    }

    /**
     * Remove the specified transaction.
     */
    public function destroy(Transaction $transaction): RedirectResponse
    {
        $transaction->delete();

        return redirect()->route('staff.transactions.index')
            ->with('success', 'Transaction deleted successfully.');
    }
}

