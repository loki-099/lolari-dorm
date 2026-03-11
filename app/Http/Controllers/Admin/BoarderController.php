<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Boarder;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class BoarderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $boarders = Boarder::with(['user', 'assignments.room'])->paginate(15);
        return view('admin.boarders.index', compact('boarders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.boarders.create');
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
            'contact' => 'nullable|string|max:20',
            'home_address' => 'nullable|string|max:500',
            'parent_contact' => 'nullable|string|max:20',
        ]);

        // Create user first
        $user = User::create([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'email' => $validated['email'],
            'contact_number' => $validated['contact'],
            'role' => 'user',
            'password' => Hash::make('boarder123'), // Default password
        ]);

        // Assign boarder role
        // $user->assignRole('boarder'); Complicated ahh role

        // Create boarder record
        $boarder = Boarder::create([
            'user_id' => $user->id, 
            'home_address' => $validated['home_address'] ?? null,
            'parent_contact' => $validated['parent_contact'] ?? null,
            'status' => 'active',
        ]);

        return redirect()->route('admin.rooms.assign-form', ['boarder' => $boarder->id])
            ->with('success', 'Boarder created successfully! Now assign a room.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Boarder $boarder)
    {
        $boarder->load('user', 'assignments.room', 'transactions');
        return view('admin.boarders.show', compact('boarder'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Boarder $boarder)
    {
        $boarder->load('user');
        return view('admin.boarders.edit', compact('boarder'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Boarder $boarder)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $boarder->user_id,
            'contact' => 'nullable|string|max:20',
            'home_address' => 'nullable|string|max:500',
            'parent_contact' => 'nullable|string|max:20',
            'documents_path' => 'nullable|string',
            'status' => 'required|in:active,inactive,suspended',
        ]);

        // Update user
        $boarder->user->update([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'email' => $validated['email'],
        ]);

        // Update boarder
        $boarder->update([
            'contact' => $validated['contact'],
            'home_address' => $validated['home_address'] ?? null,
            'parent_contact' => $validated['parent_contact'] ?? null,
            'documents_path' => $validated['documents_path'] ?? null,
            'status' => $validated['status'],
        ]);

        return redirect()->route('admin.boarders.show', $boarder)
            ->with('success', 'Boarder updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Boarder $boarder)
    {
        // Prevent deletion if boarder has active assignments
        if ($boarder->assignments()->whereNull('end_date')->exists()) {
            return redirect()->route('admin.boarders.show', $boarder)
                ->with('error', 'Cannot delete boarder with active room assignment. End the assignment first.');
        }

        $name = $boarder->user->first_name . ' ' . $boarder->user->last_name;
        
        // Delete user (will cascade to boarder due to foreign key)
        $boarder->user->delete();

        return redirect()->route('admin.boarders.index')
            ->with('success', "Boarder '{$name}' has been deleted successfully.");
    }
}

