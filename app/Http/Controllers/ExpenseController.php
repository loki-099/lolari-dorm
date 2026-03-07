<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the expenses.
     */
    public function index(): View
    {
        $expenses = Expense::getAll();
        $totalExpenses = Expense::getTotal();

        return view('expenses-page.expenses', compact('expenses', 'totalExpenses'));
    }

    /**
     * Store a newly created expense in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'description' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'staff' => 'required|string|max:255',
        ]);

        Expense::createExpense($validated);

        return redirect()->route('expenses.index')
            ->with('success', 'Expense added successfully!');
    }

    /**
     * Remove the specified expense from storage.
     */
    public function destroy(Request $request)
    {
        $id = (int) $request->route('expense');
        Expense::deleteExpense($id);

        return redirect()->route('expenses.index')
            ->with('success', 'Expense deleted successfully!');
    }
    
    /**
     * Update the specified expense in storage.
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'description' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'staff' => 'required|string|max:255',
        ]);

        $id = (int) $request->route('expense');
        Expense::updateExpense($id, $validated);

        return redirect()->route('expenses.index')
            ->with('success', 'Expense updated successfully!');
    }
}

