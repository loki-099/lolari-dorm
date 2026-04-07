<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\Boarder;
use App\Models\Assignment;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource with filtering.
     */
    public function index(Request $request)
    {
        $query = Room::query();

        // Filter by status
        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }

        // Filter by type
        if ($request->has('type') && $request->type) {
            $query->where('type', $request->type);
        }

        $rooms = $query->paginate(15);
        $statuses = ['available', 'occupied', 'maintenance'];
        $types = ['single', 'double', 'triple'];

        return view('staff.rooms.index', compact('rooms', 'statuses', 'types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('staff.rooms.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'number' => 'required|string|unique:rooms,number',
            'type' => 'required|in:single,double,triple',
            'price' => 'required|numeric|min:0',
            'status' => 'required|in:available,occupied,maintenance',
        ]);

        Room::create($validated);

        return redirect()->route('staff.rooms.index')
            ->with('success', 'Room created successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Room $room)
    {
        return view('staff.rooms.edit', compact('room'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Room $room)
    {
        $validated = $request->validate([
            'number' => 'required|string|unique:rooms,number,' . $room->id,
            'type' => 'required|in:single,double,triple',
            'price' => 'required|numeric|min:0',
            'status' => 'required|in:available,occupied,maintenance',
        ]);

        $room->update($validated);

        return redirect()->route('staff.rooms.show', $room)
            ->with('success', 'Room updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Room $room)
    {
        // Prevent deletion if room has active assignments
        if ($room->assignments()->where('status', 'active')->exists()) {
            return redirect()->route('staff.rooms.index')
                ->with('error', 'Cannot delete room with active assignments. Please end the assignment first.');
        }

        $room->delete();

        return redirect()->route('staff.rooms.index')
            ->with('success', 'Room deleted successfully!');
    }

    /**
     * Show the form for assigning a boarder to a room.
     */
    public function assignForm(Request $request)
    {
        $boarder = null;
        if ($request->has('boarder')) {
            $boarder = Boarder::findOrFail($request->boarder);
        }

        $availableRooms = Room::where('status', 'available')->get();
        return view('staff.rooms.assign', compact('boarder', 'availableRooms'));
    }

    /**
     * Assign a boarder to a room and update room status.
     */
    public function assign(Request $request)
    {
        $validated = $request->validate([
            'boarder_id' => 'required|exists:boarders,id',
            'room_id' => 'required|exists:rooms,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);

        $activeAssignmentInSameRoom = Assignment::where('boarder_id', $validated['boarder_id'])
            ->where('room_id', $validated['room_id'])
            ->where('status', 'active')
            ->exists();

        if ($activeAssignmentInSameRoom) {
            return back()
                ->withInput()
                ->withErrors(['room_id' => 'This boarder is already assigned to the selected room.']);
        }

        // Create assignment
        Assignment::create([
            'boarder_id' => $validated['boarder_id'],
            'room_id' => $validated['room_id'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'due_day' => 1,
        ]);

        // Update room status to occupied
        $room = Room::find($validated['room_id']);
        $room->update(['status' => 'occupied']);

        return redirect()->route('staff.dashboard')
            ->with('success', 'Room assigned to boarder successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Room $room)
    {
        $room->load('assignments.boarder');
        return view('staff.rooms.show', compact('room'));
    }
}
