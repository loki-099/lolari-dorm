@extends('layouts.admin')

@section('title', 'Room ' . $room->number)

@section('content')
<div class="space-y-6">
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

    <div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 sm:p-6 dark:bg-gray-800 mt-2">
        <div class="flex flex-col gap-4 md:flex-row md:items-start md:justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Room {{ $room->number }}</h1>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Detailed room information and current assigned boarders.</p>
            </div>

            <div class="flex flex-wrap gap-2">
                <a href="{{ route('admin.rooms.edit', $room) }}" class="inline-flex items-center gap-2 rounded-lg bg-blue-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Edit
                </a>
                @if(!$room->assignments()->where('status', 'active')->exists())
                    <form action="{{ route('admin.rooms.destroy', $room) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this room?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="inline-flex items-center gap-2 rounded-lg bg-red-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-red-800 focus:ring-4 focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                            Delete
                        </button>
                    </form>
                @endif
            </div>
        </div>

        <div class="mt-6 grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
            <div class="rounded-lg bg-gray-50 p-4 dark:bg-gray-700/50">
                <p class="text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">Capacity</p>
                <p class="mt-1 text-xl font-bold text-gray-900 dark:text-white">{{ $room->capacity }}</p>
            </div>
            <div class="rounded-lg bg-gray-50 p-4 dark:bg-gray-700/50">
                <p class="text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">Monthly Rent</p>
                <p class="mt-1 text-xl font-bold text-gray-900 dark:text-white">PHP {{ number_format($room->monthly_rent, 2) }}</p>
            </div>
            <div class="rounded-lg bg-gray-50 p-4 dark:bg-gray-700/50">
                <p class="text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">Current Occupancy</p>
                <p class="mt-1 text-xl font-bold text-gray-900 dark:text-white">{{ $room->assignments->where('status', 'active')->count() }} / {{ $room->capacity }}</p>
            </div>
            <div class="rounded-lg bg-gray-50 p-4 dark:bg-gray-700/50">
                <p class="text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">Status</p>
                <p class="mt-1">
                    @if($room->status === 'available')
                        <span class="inline-flex items-center rounded-full border border-green-200 bg-green-100 px-2.5 py-0.5 text-xs font-medium text-green-800 dark:border-green-800 dark:bg-green-900/30 dark:text-green-300">Available</span>
                    @elseif($room->status === 'occupied')
                        <span class="inline-flex items-center rounded-full border border-blue-200 bg-blue-100 px-2.5 py-0.5 text-xs font-medium text-blue-800 dark:border-blue-800 dark:bg-blue-900/30 dark:text-blue-300">Occupied</span>
                    @else
                        <span class="inline-flex items-center rounded-full border border-amber-200 bg-amber-100 px-2.5 py-0.5 text-xs font-medium text-amber-800 dark:border-amber-800 dark:bg-amber-900/30 dark:text-amber-300">Maintenance</span>
                    @endif
                </p>
            </div>
        </div>
    </div>

    <div class="overflow-hidden rounded-lg border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800">
        <div class="border-b border-gray-200 px-4 py-4 dark:border-gray-700 sm:px-6">
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Current Assigned Boarders</h2>
        </div>
        <div class="relative overflow-x-auto">
            <table class="w-full text-left text-sm text-gray-500 dark:text-gray-400">
                <thead class="bg-gray-50 text-xs uppercase text-gray-700 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th class="px-6 py-3">Boarder</th>
                        <th class="px-6 py-3">Start Date</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    @php
                        $activeAssignments = $room->assignments->where('status', 'active')->sortByDesc('start_date');
                    @endphp
                    @forelse($activeAssignments as $assignment)
                        <tr class="bg-white hover:bg-gray-50 dark:bg-gray-800 dark:hover:bg-gray-700">
                            <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                {{ $assignment->boarder->user->first_name ?? 'N/A' }} {{ $assignment->boarder->user->last_name ?? '' }}
                            </td>
                            <td class="px-6 py-4">{{ optional($assignment->start_date)->format('M d, Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2" class="px-6 py-8 text-center text-gray-500 dark:text-gray-400">No boarder is currently assigned to this room.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div>
        <a href="{{ route('admin.rooms.index') }}" class="inline-flex items-center rounded-lg border border-gray-300 bg-white px-5 py-2.5 text-sm font-medium text-gray-900 hover:bg-gray-50 focus:ring-4 focus:ring-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Back to Rooms</a>
    </div>
</div>
@endsection

