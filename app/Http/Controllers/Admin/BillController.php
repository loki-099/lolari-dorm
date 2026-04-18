<?php

namespace App\Http\Controllers\Admin;

use App\Models\UtilityBill;
use App\Models\Room;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BillController extends Controller
{
    /**
     * Display a listing of all bills organized by room and boarder.
     */
    public function index(Request $request)
    {
        $query = UtilityBill::query()
            ->with(['room.activeAssignments.boarder.user'])
            ->orderBy('billing_month', 'desc')
            ->orderBy('created_at', 'desc');

        // Filter by room if provided
        if ($request->filled('room_id')) {
            $query->where('room_id', $request->room_id);
        }

        // Filter by status if provided
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by type if provided
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        $bills = $query->paginate(20);
        $rooms = Room::orderBy('number')->get();

        return view('admin.bills.index', compact('bills', 'rooms'));
    }

    /**
     * Show the form for creating a new bill.
     */
    public function create()
    {
        $rooms = Room::with(['activeAssignments.boarder.user'])
            ->orderBy('number')
            ->get();

        return view('admin.bills.create', compact('rooms'));
    }

    /**
     * Store a newly created bill in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'room_id' => ['required', 'exists:rooms,id'],
            'type' => ['required', 'in:electricity,water,internet'],
            'amount' => ['required', 'numeric', 'min:0.01'],
            'billing_month' => ['required', 'date'],
            'due_date' => ['required', 'date', 'after_or_equal:billing_month'],
            'status' => ['required', 'in:paid,unpaid'],
        ]);

        UtilityBill::create($validated);

        return redirect()
            ->route('admin.bills.index')
            ->with('success', 'Bill created successfully.');
    }

    /**
     * Display the specified bill.
     */
    public function show(UtilityBill $bill)
    {
        $bill->load(['room.activeAssignments.boarder.user']);

        return view('admin.bills.show', compact('bill'));
    }

    /**
     * Show the form for editing the specified bill.
     */
    public function edit(UtilityBill $bill)
    {
        $rooms = Room::with(['activeAssignments.boarder.user'])
            ->orderBy('number')
            ->get();

        return view('admin.bills.edit', compact('bill', 'rooms'));
    }

    /**
     * Update the specified bill in storage.
     */
    public function update(Request $request, UtilityBill $bill)
    {
        $validated = $request->validate([
            'room_id' => ['required', 'exists:rooms,id'],
            'type' => ['required', 'in:electricity,water,internet'],
            'amount' => ['required', 'numeric', 'min:0.01'],
            'billing_month' => ['required', 'date'],
            'due_date' => ['required', 'date', 'after_or_equal:billing_month'],
            'status' => ['required', 'in:paid,unpaid'],
        ]);

        $bill->update($validated);

        return redirect()
            ->route('admin.bills.index')
            ->with('success', 'Bill updated successfully.');
    }

    /**
     * Remove the specified bill from storage.
     */
    public function destroy(UtilityBill $bill)
    {
        $bill->delete();

        return redirect()
            ->route('admin.bills.index')
            ->with('success', 'Bill deleted successfully.');
    }
}
