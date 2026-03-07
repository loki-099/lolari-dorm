@extends('staff.layouts.app')

@section('title', 'Rooms')

@section('content')
<div class="space-y-6">
    <!-- Header with Action Button -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <p class="text-gray-600 dark:text-gray-400 text-sm">Manage and monitor all dormitory rooms</p>
        </div>
        <a href="{{ route('staff.rooms.create') }}" style="display: none;" class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 dark:bg-blue-700 dark:hover:bg-blue-800 rounded-lg transition-colors">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Add Room
        </a>
    </div>

    <!-- Filters Card -->
    <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow p-4 md:p-6">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Filter Rooms</h3>
        <form action="{{ route('staff.rooms.index') }}" method="GET" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <!-- Status Filter -->
            <div>
                <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Status</label>
                <select name="status" id="status" class="w-full px-4 py-2 text-sm text-gray-900 dark:text-white dark:bg-gray-700 bg-white border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-600 dark:focus:ring-blue-500 focus:border-transparent">
                    <option value="">All Status</option>
                    @foreach(['available', 'occupied', 'maintenance'] as $s)
                        <option value="{{ $s }}" @selected(request('status') === $s)>{{ ucfirst($s) }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Type Filter -->
            <div>
                <label for="type" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Type</label>
                <select name="type" id="type" class="w-full px-4 py-2 text-sm text-gray-900 dark:text-white dark:bg-gray-700 bg-white border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-600 dark:focus:ring-blue-500 focus:border-transparent">
                    <option value="">All Types</option>
                    @foreach(['single', 'double', 'triple'] as $t)
                        <option value="{{ $t }}" @selected(request('type') === $t)>{{ ucfirst($t) }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Search by Room Number -->
            <div>
                <label for="search" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Room Number</label>
                <input type="text" name="search" id="search" placeholder="Search..." 
                    class="w-full px-4 py-2 text-sm text-gray-900 dark:text-white dark:bg-gray-700 bg-white border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-600 dark:focus:ring-blue-500 focus:border-transparent"
                    value="{{ request('search') }}">
            </div>

            <!-- Filter Button -->
            <div class="flex items-end gap-2">
                <button type="submit" class="px-5 py-2.5 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 dark:bg-blue-700 dark:hover:bg-blue-800 border border-transparent rounded-lg transition-colors w-full sm:w-auto">
                    Apply Filters
                </button>
                @if(request()->hasAny(['status', 'type', 'search']))
                    <a href="{{ route('staff.rooms.index') }}" class="px-4 py-2.5 text-sm font-medium text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 border border-gray-300 dark:border-gray-600 rounded-lg transition-colors">
                        Clear
                    </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Rooms Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($rooms as $room)
            <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow hover:shadow-lg dark:hover:shadow-gray-700/50 transition-shadow overflow-hidden">
                <!-- Status Top Border -->
                <div class="h-1 @if($room->status === 'available') bg-green-500 @elseif($room->status === 'occupied') bg-blue-500 @else bg-red-500 @endif"></div>
                
                <div class="p-6">
                    <!-- Room Header -->
                    <div class="flex items-start justify-between mb-4">
                        <div>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white">Room {{ $room->number }}</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400 capitalize mt-1">{{ $room->type }} Room</p>
                        </div>
                        @if($room->status === 'available')
                            <span class="inline-flex items-center px-3 py-1 text-xs font-semibold text-green-800 dark:text-green-300 bg-green-100 dark:bg-green-900/30 rounded-full border border-green-200 dark:border-green-800">
                                <span class="w-2 h-2 bg-green-500 rounded-full mr-2"></span>
                                Available
                            </span>
                        @elseif($room->status === 'occupied')
                            <span class="inline-flex items-center px-3 py-1 text-xs font-semibold text-blue-800 dark:text-blue-300 bg-blue-100 dark:bg-blue-900/30 rounded-full border border-blue-200 dark:border-blue-800">
                                <span class="w-2 h-2 bg-blue-500 rounded-full mr-2"></span>
                                Occupied
                            </span>
                        @else
                            <span class="inline-flex items-center px-3 py-1 text-xs font-semibold text-red-800 dark:text-red-300 bg-red-100 dark:bg-red-900/30 rounded-full border border-red-200 dark:border-red-800">
                                <span class="w-2 h-2 bg-red-500 rounded-full mr-2"></span>
                                Maintenance
                            </span>
                        @endif
                    </div>

                    <!-- Price -->
                    <div class="border-t border-b border-gray-200 dark:border-gray-700 py-4 mb-4">
                        <p class="text-gray-600 dark:text-gray-400 text-sm">Monthly Rate</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white">₱{{ number_format($room->price, 2) }}</p>
                    </div>

                    <!-- Room Stats -->
                    <div class="space-y-3 mb-6">
                        <!-- Capacity -->
                        <div class="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-400">
                            <svg class="w-4 h-4 text-gray-400 dark:text-gray-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10.5 1.5H5a1.5 1.5 0 00-1.5 1.5v12a1.5 1.5 0 001.5 1.5h10a1.5 1.5 0 001.5-1.5V3a1.5 1.5 0 00-1.5-1.5z"></path>
                            </svg>
                            <span class="capitalize">{{ $room->type }} accommodation</span>
                        </div>

                        <!-- Current Occupancy -->
                        @php
                            $currentAssignment = $room->assignments()
                                ->whereNull('end_date')
                                ->orWhere('end_date', '>=', now())
                                ->latest('start_date')
                                ->first();
                        @endphp
                        @if($currentAssignment)
                            <div class="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-400">
                                <svg class="w-4 h-4 text-blue-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"></path>
                                </svg>
                                <span>{{ $currentAssignment->boarder->name }}</span>
                            </div>
                        @else
                            <div class="flex items-center gap-2 text-sm text-gray-500 dark:text-gray-500">
                                <svg class="w-4 h-4 text-gray-400 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M13 7H7v6h6V7z"></path>
                                </svg>
                                <span>No current occupant</span>
                            </div>
                        @endif

                        <!-- Total Assignments -->
                        <div class="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-400">
                            <svg class="w-4 h-4 text-amber-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M5.5 12a3.5 3.5 0 01-.369-6.98 4 4 0 117.539-1.257A4.5 4.5 0 1113.5 13H11V9.413l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13H5.5z"></path>
                            </svg>
                            <span>{{ $room->assignments()->count() }} assignment(s)</span>
                        </div>
                    </div>

                    <!-- Action Button -->
                    <a href="{{ route('staff.rooms.show', $room) }}" class="w-full inline-flex items-center justify-center px-4 py-2.5 text-sm font-medium text-blue-600 dark:text-blue-400 bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg hover:bg-blue-100 dark:hover:bg-blue-900/30 transition-colors">
                        View Details & Assignments
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>
            </div>
        @empty
            <div class="col-span-full">
                <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow py-12 px-6">
                    <div class="flex flex-col items-center gap-4">
                        <svg class="w-12 h-12 text-gray-400 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m0 0l8 4m-8-4v10l8 4m0-10l8-4m-8 4v10l8-4m-8-4l8 4"></path>
                        </svg>
                        <p class="text-gray-600 dark:text-gray-400 text-lg font-medium">No rooms found</p>
                        <p class="text-gray-500 dark:text-gray-500 text-sm">Try adjusting your filters</p>
                    </div>
                </div>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($rooms->count() > 0)
        <div class="flex justify-center">
            <div class="flex gap-1">
                {{ $rooms->links() }}
            </div>
        </div>
    @endif
</div>

<!-- Custom Pagination Styling -->
<style>
    .pagination {
        display: flex;
        gap: 0.25rem;
        list-style: none;
        margin: 0;
        padding: 0;
    }

    .pagination li {
        margin: 0;
    }

    .pagination a,
    .pagination span {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0.5rem 0.75rem;
        text-decoration: none;
        font-size: 0.875rem;
        font-weight: 500;
        border-radius: 0.375rem;
        border: 1px solid #e5e7eb;
        color: #374151;
        transition: all 0.2s;
    }

    .dark .pagination a,
    .dark .pagination span {
        border-color: #4b5563;
        color: #d1d5db;
    }

    .pagination a:hover {
        background-color: #f3f4f6;
        color: #1f2937;
    }

    .dark .pagination a:hover {
        background-color: #374151;
        color: #f3f4f6;
    }

    .pagination .active span {
        background-color: #2563eb;
        border-color: #2563eb;
        color: white;
    }

    .dark .pagination .active span {
        background-color: #1d4ed8;
        border-color: #1d4ed8;
    }

    .pagination .disabled span {
        color: #9ca3af;
        background-color: #f9fafb;
        cursor: not-allowed;
    }

    .dark .pagination .disabled span {
        color: #6b7280;
        background-color: #2d3748;
    }
</style>@endsection