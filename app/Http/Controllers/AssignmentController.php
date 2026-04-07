<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use Illuminate\Http\Request;
use App\Models\Boarder;
use App\Models\Room;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\Rule;

class AssignmentController extends Controller
{
    public function index()
    {
        $boarders = Boarder::with('user')
            ->where('status', 'active')
            ->get();

        $availableRooms = Room::withCount([
            'assignments as active_assignments_count' => function ($query) {
                $query->where('status', 'active');
            }
        ])->get()->filter(function ($room) {
            return $room->active_assignments_count < $room->capacity;
        })->values();

        $hasDueDay = Schema::hasColumn('assignments', 'due_day');

        return view('admin.assignments.index', compact('boarders', 'availableRooms', 'hasDueDay'));
    }

    public function store(Request $request)
    {
        $hasDueDay = Schema::hasColumn('assignments', 'due_day');

        $rules = [
            'boarder_id' => ['required', Rule::exists('boarders', 'id')],
            'room_id' => ['required', Rule::exists('rooms', 'id')],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date', 'after:start_date'],
        ];

        $validated = $request->validate($rules);

        $targetRoom = Room::findOrFail($validated['room_id']);
        $targetRoomActiveCount = Assignment::where('room_id', $targetRoom->id)
            ->where('status', 'active')
            ->count();

        $activeAssignmentInSameRoom = Assignment::where('boarder_id', $validated['boarder_id'])
            ->where('room_id', $validated['room_id'])
            ->where('status', 'active')
            ->exists();

        if ($activeAssignmentInSameRoom) {
            return back()
                ->withInput()
                ->withErrors(['room_id' => 'This boarder is already assigned to the selected room.']);
        }

        if ($targetRoomActiveCount >= $targetRoom->capacity) {
            return back()
                ->withInput()
                ->withErrors(['room_id' => 'The selected room is already at full capacity.']);
        }

        DB::transaction(function () use ($validated, $hasDueDay) {
            $previousRoomIds = Assignment::where('boarder_id', $validated['boarder_id'])
                ->where('status', 'active')
                ->pluck('room_id');

            Assignment::where('boarder_id', $validated['boarder_id'])
                ->where('status', 'active')
                ->update(['status' => 'inactive']);

            $payload = [
                'boarder_id' => $validated['boarder_id'],
                'room_id' => $validated['room_id'],
                'start_date' => $validated['start_date'],
                'end_date' => $validated['end_date'],
                'status' => 'active',
            ];

            if ($hasDueDay) {
                $payload['due_day'] = 1;
            }

            Assignment::create($payload);

            $this->syncRoomStatus($validated['room_id']);

            foreach ($previousRoomIds as $previousRoomId) {
                if ((int) $previousRoomId !== (int) $validated['room_id']) {
                    $this->syncRoomStatus($previousRoomId);
                }
            }
        });

        return redirect()
            ->route('admin.assignments.index')
            ->with('success', 'Room assigned to boarder successfully.');
    }

    private function syncRoomStatus(int $roomId): void
    {
        $activeCount = Assignment::where('room_id', $roomId)
            ->where('status', 'active')
            ->count();

        Room::where('id', $roomId)->update([
            'status' => $activeCount > 0 ? 'occupied' : 'available',
        ]);
    }
}
