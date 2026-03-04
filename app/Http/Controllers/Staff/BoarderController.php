<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Boarder;
use Illuminate\Http\Request;

class BoarderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $boarders = Boarder::with('assignments.room')->paginate(15);
        return view('staff.boarders.index', compact('boarders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('staff.boarders.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'contact' => 'nullable|string|max:20',
            'documents_path' => 'nullable|string',
        ]);

        $boarder = Boarder::create($validated);

        return redirect()->route('staff.rooms.assign-form', ['boarder' => $boarder->id])
            ->with('success', 'Boarder created successfully! Now assign a room.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Boarder $boarder)
    {
        $boarder->load('assignments.room', 'transactions');
        return view('staff.boarders.show', compact('boarder'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Boarder $boarder)
    {
        return view('staff.boarders.edit', compact('boarder'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Boarder $boarder)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'contact' => 'nullable|string|max:20',
            'documents_path' => 'nullable|string',
            'status' => 'required|in:active,inactive,suspended',
        ]);

        $boarder->update($validated);

        return redirect()->route('staff.boarders.show', $boarder)
            ->with('success', 'Boarder updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Boarder $boarder)
    {
        // Prevent deletion if boarder has active assignments
        if ($boarder->assignments()->whereNull('end_date')->exists()) {
            return redirect()->route('staff.boarders.show', $boarder)
                ->with('error', 'Cannot delete boarder with active room assignment. End the assignment first.');
        }

        $name = $boarder->name;
        $boarder->delete();

        return redirect()->route('staff.boarders.index')
            ->with('success', "Boarder '{$name}' has been deleted successfully.");
    }
}
