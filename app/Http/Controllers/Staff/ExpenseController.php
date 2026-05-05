<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use App\Models\Room;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ExpenseController extends Controller
{
    /**
     * Display a listing of expenses.
     */
    public function index(): View
    {
        $expenses = Expense::with(['room', 'staff.user'])
            ->latest()
            ->paginate(15);

        return view('staff.expenses.index', compact('expenses'));
    }

    /**
     * Show the form for creating a new expense.
     */
    public function create(): View
    {
        $rooms = Room::all();
        $staffs = Staff::with('user')->get();

        return view('staff.expenses.create', compact('rooms', 'staffs'));
    }

    /**
     * Store a newly created expense.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'staff_id' => 'required|exists:staffs,id',
            'expense_type' => 'required|in:maintenance,others',
            'description' => 'nullable|string|max:255',
            'amount' => 'required|numeric|min:0.01',
            'expense_date' => 'nullable|date',
        ]);

        $validated['expense_date'] = $validated['expense_date'] ?? now()->toDateString();

        Expense::create($validated);

        return redirect()->route('staff.expenses.index')
            ->with('success', 'Expense created successfully.');
    }

    /**
     * Display the specified expense.
     */
    public function show(Expense $expense): View
    {
        $expense->load(['room', 'staff.user']);

        return view('staff.expenses.show', compact('expense'));
    }

    /**
     * Show the form for editing the specified expense.
     */
    public function edit(Expense $expense): View
    {
        $rooms = Room::all();
        $staffs = Staff::with('user')->get();
        $expense->load(['room', 'staff']);

        return view('staff.expenses.edit', compact('expense', 'rooms', 'staffs'));
    }

    /**
     * Update the specified expense.
     */
    public function update(Request $request, Expense $expense): RedirectResponse
    {
        $validated = $request->validate([
            'room_id' => 'sometimes|exists:rooms,id',
            'staff_id' => 'sometimes|exists:staffs,id',
            'expense_type' => 'sometimes|in:maintenance,others',
            'description' => 'sometimes|string|max:255',
            'amount' => 'sometimes|numeric|min:0.01',
            'expense_date' => 'sometimes|date',
        ]);

        $expense->update($validated);

        return redirect()->route('staff.expenses.index')
            ->with('success', 'Expense updated successfully.');
    }

    /**
     * Remove the specified expense.
     */
    public function destroy(Expense $expense): RedirectResponse
    {
        $expense->delete();

        return redirect()->route('staff.expenses.index')
            ->with('success', 'Expense deleted successfully.');
    }
}
