@extends('staff.layouts.app')

@section('title', 'Room ' . $room->number)

@section('content')
<div class="space-y-6">
    <!-- Room Info Card -->
    <div class="bg-white border border-gray-200 rounded-lg shadow-md p-6">
        <div class="flex justify-between items-start mb-6">
            <div class="flex-1">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Room {{ $room->number }}</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <p class="text-xs text-gray-600 font-semibold uppercase mb-1">Room Type</p>
                        <p class="inline-flex items-center gap-2 px-3 py-1 bg-blue-100 text-blue-700 text-sm font-semibold rounded-lg">
                            <span class="w-2 h-2 bg-blue-600 rounded-full"></span>
                            {{ ucfirst($room->type) }}
                        </p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-600 font-semibold uppercase mb-1">Monthly Rate</p>
                        <p class="text-2xl font-bold text-green-600">₱{{ number_format($room->price, 2) }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-600 font-semibold uppercase mb-1">Current Status</p>
                        @if($room->status === 'available')
                            <span class="inline-flex items-center gap-2 px-3 py-1 rounded-lg text-sm font-semibold text-green-700 bg-green-100">
                                <span class="w-2 h-2 bg-green-600 rounded-full"></span>
                                Available
                            </span>
                        @elseif($room->status === 'occupied')
                            <span class="inline-flex items-center gap-2 px-3 py-1 rounded-lg text-sm font-semibold text-blue-700 bg-blue-100">
                                <span class="w-2 h-2 bg-blue-600 rounded-full"></span>
                                Occupied
                            </span>
                        @else
                            <span class="inline-flex items-center gap-2 px-3 py-1 rounded-lg text-sm font-semibold text-red-700 bg-red-100">
                                <span class="w-2 h-2 bg-red-600 rounded-full"></span>
                                Maintenance
                            </span>
                        @endif
                    </div>
                </div>
            </div>
            
            <!-- Action Buttons -->
            <div class="flex flex-col gap-2 ml-6">
                <a href="{{ route('staff.rooms.edit', $room) }}" class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    Edit
                </a>
                @if(!$room->assignments()->whereNull('end_date')->exists())
                    <form action="{{ route('staff.rooms.destroy', $room) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this room?');" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700 transition-all">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                            Delete
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </div>

    <!-- Current Occupant -->
    <div class="bg-white border border-gray-200 rounded-lg shadow-md p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Current Occupant</h3>
        @php
            $activeAssignment = $room->assignments
                ->where('end_date', null)
                ->first();
        @endphp

        @if($activeAssignment)
            <div class="bg-blue-50 border-l-4 border-blue-500 rounded-lg p-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <p class="text-xs text-gray-600 font-semibold uppercase">Boarder Name</p>
                        <p class="font-semibold text-gray-900 mt-1">
                            <a href="{{ route('staff.boarders.show', $activeAssignment->boarder) }}" class="text-blue-600 hover:text-blue-800">
                                {{ $activeAssignment->boarder->name }}
                            </a>
                        </p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-600 font-semibold uppercase">Contact</p>
                        <p class="font-semibold text-gray-900 mt-1">{{ $activeAssignment->boarder->contact ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-600 font-semibold uppercase">Start Date</p>
                        <p class="font-semibold text-gray-900 mt-1">{{ $activeAssignment->start_date->format('M d, Y') }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-600 font-semibold uppercase">Duration</p>
                        <p class="font-semibold text-gray-900 mt-1">{{ $activeAssignment->start_date->diffInDays(now()) }} days</p>
                    </div>
                </div>
            </div>
        @else
            <div class="bg-gray-50 border border-gray-200 rounded-lg p-6">
                <p class="text-gray-700 font-medium mb-4">This room is currently unoccupied.</p>
                <a href="{{ route('staff.rooms.assign-form') }}" class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Assign a Boarder
                </a>
            </div>
        @endif
    </div>

    <!-- Assignment History -->
    <div class="bg-white border border-gray-200 rounded-lg shadow-md p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Assignment History</h3>

        @if($room->assignments->isNotEmpty())
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-gray-700">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-4 py-3 text-left font-semibold text-gray-900">Boarder Name</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-900">Check-in</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-900">Check-out</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-900">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($room->assignments->sortByDesc('start_date') as $assignment)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-4 py-3">
                                    <a href="{{ route('staff.boarders.show', $assignment->boarder) }}" class="text-blue-600 hover:text-blue-800 font-medium">
                                        {{ $assignment->boarder->name }}
                                    </a>
                                </td>
                                <td class="px-4 py-3">{{ $assignment->start_date->format('M d, Y') }}</td>
                                <td class="px-4 py-3">{{ $assignment->end_date ? $assignment->end_date->format('M d, Y') : '-' }}</td>
                                <td class="px-4 py-3">
                                    @if($assignment->end_date === null)
                                        <span class="inline-flex items-center gap-2 px-3 py-1 text-xs font-semibold text-green-700 bg-green-100 rounded-full">
                                            <span class="w-2 h-2 bg-green-600 rounded-full"></span>
                                            Active
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-2 px-3 py-1 text-xs font-semibold text-gray-700 bg-gray-100 rounded-full">
                                            <span class="w-2 h-2 bg-gray-600 rounded-full"></span>
                                            Completed
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-4 py-6 text-center text-gray-500">
                                    No assignment history yet.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-gray-600 text-center py-4">No assignment history yet.</p>
        @endif
    </div>

    <!-- Navigation -->
    <div class="flex items-center gap-3">
        <a href="{{ route('staff.rooms.index') }}" class="inline-flex items-center gap-2 px-6 py-3 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-all">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Back to Rooms
        </a>
    </div>
</div>
@endsection
