<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Staff;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $staffs = Staff::with(['user'])->paginate(15);
        return view('admin.staffs.index', compact('staffs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.staffs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'contact_number' => 'nullable|string|max:20',
            'employment_date' => 'required|date',
        ]);

        // Create user first
        $user = User::create([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'email' => $validated['email'],
            'contact_number' => $validated['contact_number'],
            'role' => 'staff',
            'password' => Hash::make('staff123'), // Default password
        ]);

        // Create staff record
        $staff = Staff::create([
            'user_id' => $user->id, 
            'employment_date' => $validated['employment_date'],
            'status' => 'active',
        ]);

        return redirect()->route('admin.staffs.index')
            ->with('success', 'Staff created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Staff $staff)
    {
        $staff->load('user', 'transactions');
        return view('admin.staffs.show', compact('staff'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Staff $staff)
    {
        $staff->load('user');
        return view('admin.staffs.edit', compact('staff'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Staff $staff)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $staff->user_id,
            'contact_number' => 'nullable|string|max:20',
            'employment_date' => 'required|date',
            'status' => 'required|in:active,inactive',
        ]);

        // Update user
        $staff->user->update([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'email' => $validated['email'],
            'contact_number' => $validated['contact_number'] ?? null,
        ]);

        // Update staff
        $staff->update([
            'employment_date' => $validated['employment_date'],
            'status' => $validated['status'],
        ]);

        return redirect()->route('admin.staffs.show', $staff)
            ->with('success', 'Staff updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Staff $staff)
    {
        $name = $staff->user->first_name . ' ' . $staff->user->last_name;
        
        // Delete user (cascade deletes staff)
        $staff->user->delete();

        return redirect()->route('admin.staffs.index')
            ->with('success', "Staff '{$name}' deleted successfully.");
    }
}
?>

