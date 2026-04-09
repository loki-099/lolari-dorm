@extends('layouts.admin')

@section('title', 'Rooms')

@section('content')
<div class="space-y-6">
    <div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 sm:p-6 dark:bg-gray-800 mt-2">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Rooms</h1>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Manage all room records and occupancy details.</p>
            </div>
            <a href="{{ route('admin.rooms.create') }}" class="inline-flex items-center justify-center gap-2 rounded-lg bg-blue-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Add Room
            </a>
        </div>
    </div>

    @if (session('success'))
        <div class="rounded-lg border border-green-200 bg-green-50 p-4 text-sm text-green-800 dark:border-green-800 dark:bg-green-900/30 dark:text-green-300">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="rounded-lg border border-red-200 bg-red-50 p-4 text-sm text-red-800 dark:border-red-800 dark:bg-red-900/30 dark:text-red-300">
            {{ session('error') }}
        </div>
    @endif

    <div class="overflow-hidden rounded-lg border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800">
        <div class="relative overflow-x-auto">
            <table class="w-full text-left text-sm text-gray-500 dark:text-gray-400">
                <thead class="bg-gray-50 text-xs uppercase text-gray-700 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th class="px-6 py-3">Room #</th>
                        <th class="px-6 py-3">Capacity</th>
                        <th class="px-6 py-3">Occupied</th>
                        <th class="px-6 py-3">Monthly Rent</th>
                        <th class="px-6 py-3">Status</th>
                        <th class="px-6 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse($rooms as $room)
                        <tr class="bg-white transition-colors hover:bg-gray-50 dark:bg-gray-800 dark:hover:bg-gray-700">
                            <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">Room {{ $room->number }}</td>
                            <td class="px-6 py-4">{{ $room->capacity }}</td>
                            <td class="px-6 py-4">{{ $room->active_boarders_count }} / {{ $room->capacity }}</td>
                            <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">PHP {{ number_format($room->monthly_rent, 2) }}</td>
                            <td class="px-6 py-4">
                                @if($room->status === 'available')
                                    <span class="inline-flex items-center rounded-full border border-green-200 bg-green-100 px-2.5 py-0.5 text-xs font-medium text-green-800 dark:border-green-800 dark:bg-green-900/30 dark:text-green-300">Available</span>
                                @elseif($room->status === 'occupied')
                                    <span class="inline-flex items-center rounded-full border border-blue-200 bg-blue-100 px-2.5 py-0.5 text-xs font-medium text-blue-800 dark:border-blue-800 dark:bg-blue-900/30 dark:text-blue-300">Occupied</span>
                                @else
                                    <span class="inline-flex items-center rounded-full border border-amber-200 bg-amber-100 px-2.5 py-0.5 text-xs font-medium text-amber-800 dark:border-amber-800 dark:bg-amber-900/30 dark:text-amber-300">Maintenance</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <a href="{{ route('admin.rooms.show', $room) }}" class="font-medium text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">View</a>
                                    <a href="{{ route('admin.rooms.edit', $room) }}" class="font-medium text-green-600 hover:text-green-800 dark:text-green-400 dark:hover:text-green-300">Edit</a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-10 text-center text-gray-500 dark:text-gray-400">No rooms found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if($rooms->hasPages())
        <div>
            {{ $rooms->links() }}
        </div>
    @endif
</div>
@endsection

