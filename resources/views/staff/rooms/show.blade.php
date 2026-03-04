@extends('staff.layouts.app')

@section('title', 'Room ' . $room->number)

@section('content')
<div class="space-y-6">
    <!-- Room Info Card -->
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex justify-between items-start">
            <div>
                <h2 class="text-3xl font-bold text-gray-900">Room {{ $room->number }}</h2>
                <div class="mt-2 space-y-1">
                    <p class="text-gray-600">Type: <span class="font-medium capitalize">{{ $room->type }}</span></p>
                    <p class="text-gray-600">Price: <span class="font-medium">₱{{ number_format($room->price, 2) }}/month</span></p>
                </div>
            </div>
            <span class="px-4 py-2 rounded-full text-lg font-medium
                @if($room->status === 'available') bg-green-100 text-green-800
                @elseif($room->status === 'occupied') bg-blue-100 text-blue-800
                @else bg-red-100 text-red-800
                @endif
            ">
                {{ ucfirst($room->status) }}
            </span>
        </div>
    </div>

    <!-- Current Occupant -->
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Current Occupant</h3>
        @php
            $activeAssignment = $room->assignments
                ->where('end_date', null)
                ->first();
        @endphp

        @if($activeAssignment)
            <div class="p-4 bg-blue-50 rounded-lg border border-blue-200">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm text-gray-600">Boarder Name</p>
                        <p class="font-medium text-gray-900">
                            <a href="{{ route('staff.boarders.show', $activeAssignment->boarder) }}" class="text-blue-600 hover:text-blue-800">
                                {{ $activeAssignment->boarder->name }}
                            </a>
                        </p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Contact</p>
                        <p class="font-medium text-gray-900">{{ $activeAssignment->boarder->contact ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Start Date</p>
                        <p class="font-medium text-gray-900">{{ $activeAssignment->start_date->format('M d, Y') }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Duration</p>
                        <p class="font-medium text-gray-900">{{ $activeAssignment->start_date->diffInDays(now()) }} days</p>
                    </div>
                </div>
            </div>
        @else
            <div class="p-4 bg-gray-50 rounded-lg border border-gray-200">
                <p class="text-gray-600 mb-3">This room is currently unoccupied.</p>
                <a href="{{ route('staff.rooms.assign-form') }}" class="inline-block text-blue-600 hover:text-blue-800 font-medium">
                    Assign a Boarder →
                </a>
            </div>
        @endif
    </div>

    <!-- Assignment History -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="p-6 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">Assignment History</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Boarder</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Start Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">End Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Duration</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($room->assignments->sortByDesc('start_date') as $assignment)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 text-sm font-medium text-gray-900">
                                <a href="{{ route('staff.boarders.show', $assignment->boarder) }}" class="text-blue-600 hover:text-blue-800">
                                    {{ $assignment->boarder->name }}
                                </a>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $assignment->start_date->format('M d, Y') }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $assignment->end_date?->format('M d, Y') ?? '-' }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">
                                @if($assignment->end_date)
                                    {{ $assignment->start_date->diffInDays($assignment->end_date) }} days
                                @else
                                    {{ $assignment->start_date->diffInDays(now()) }} days
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center text-gray-500">No assignment history</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="flex gap-3">
        <a href="{{ route('staff.rooms.index') }}" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
            ← Back to Rooms
        </a>
    </div>
</div>
@endsection
