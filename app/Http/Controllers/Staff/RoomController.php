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
        ]);

        // Create assignment
        Assignment::create([
            'boarder_id' => $validated['boarder_id'],
            'room_id' => $validated['room_id'],
            'start_date' => $validated['start_date'],
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
