@extends('staff.layouts.app')

@section('title', 'Rooms')

@section('content')
<div class="space-y-6">
    <!-- Filters Card -->
    <div class="bg-white border border-gray-200 rounded-lg shadow p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Filter Rooms</h3>
        <form action="{{ route('staff.rooms.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <!-- Status Filter -->
            <div>
                <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                <select name="status" id="status" class="w-full px-4 py-2 text-sm text-gray-900 bg-white border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-600 focus:border-transparent">
                    <option value="">All Status</option>
                    @foreach(['available', 'occupied', 'maintenance'] as $s)
                        <option value="{{ $s }}" @selected(request('status') === $s)>{{ ucfirst($s) }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Type Filter -->
            <div>
                <label for="type" class="block text-sm font-medium text-gray-700 mb-2">Type</label>
                <select name="type" id="type" class="w-full px-4 py-2 text-sm text-gray-900 bg-white border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-600 focus:border-transparent">
                    <option value="">All Types</option>
                    @foreach(['single', 'double', 'triple'] as $t)
                        <option value="{{ $t }}" @selected(request('type') === $t)>{{ ucfirst($t) }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Filter Button -->
            <div class="flex items-end">
                <button type="submit" class="w-full px-5 py-2.5 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 transition-all">
                    Apply Filters
                </button>
            </div>
        </form>
    </div>

    <!-- Rooms Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($rooms as $room)
            <div class="bg-white border border-gray-200 rounded-lg shadow hover:shadow-lg transition-shadow overflow-hidden">
                <!-- Status Top Border -->
                <div class="h-1 @if($room->status === 'available') bg-green-500 @elseif($room->status === 'occupied') bg-blue-500 @else bg-red-500 @endif"></div>
                
                <div class="p-6">
                    <!-- Room Header -->
                    <div class="flex items-start justify-between mb-4">
                        <div>
                            <h3 class="text-xl font-bold text-gray-900">Room {{ $room->number }}</h3>
                            <p class="text-sm text-gray-500 capitalize mt-1">{{ $room->type }} Room</p>
                        </div>
                        @if($room->status === 'available')
                            <span class="inline-flex items-center px-3 py-1 text-xs font-semibold text-green-800 bg-green-100 rounded-full">
                                <span class="w-2 h-2 bg-green-500 rounded-full mr-2"></span>
                                Available
                            </span>
                        @elseif($room->status === 'occupied')
                            <span class="inline-flex items-center px-3 py-1 text-xs font-semibold text-blue-800 bg-blue-100 rounded-full">
                                <span class="w-2 h-2 bg-blue-500 rounded-full mr-2"></span>
                                Occupied
                            </span>
                        @else
                            <span class="inline-flex items-center px-3 py-1 text-xs font-semibold text-red-800 bg-red-100 rounded-full">
                                <span class="w-2 h-2 bg-red-500 rounded-full mr-2"></span>
                                Maintenance
                            </span>
                        @endif
                    </div>

                    <!-- Price -->
                    <div class="border-t border-b border-gray-200 py-4 mb-4">
                        <p class="text-gray-600 text-sm">Monthly Rate</p>
                        <p class="text-2xl font-bold text-gray-900">₱{{ number_format($room->price, 2) }}</p>
                    </div>

                    <!-- Details -->
                    <div class="space-y-2 mb-4">
                        <div class="flex items-center gap-2 text-sm text-gray-600">
                            <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10.5 1.5H5a1.5 1.5 0 00-1.5 1.5v12a1.5 1.5 0 001.5 1.5h10a1.5 1.5 0 001.5-1.5V3a1.5 1.5 0 00-1.5-1.5z"></path>
                            </svg>
                            <span class="capitalize">{{ $room->type }} accommodation</span>
                        </div>
                    </div>

                    <!-- Action Button -->
                    <a href="{{ route('staff.rooms.show', $room) }}" class="w-full inline-flex items-center justify-center px-4 py-2 text-sm font-medium text-blue-600 bg-blue-50 border border-blue-200 rounded-lg hover:bg-blue-100 transition-colors">
                        View Details
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>
            </div>
        @empty
            <div class="col-span-full">
                <div class="bg-white border border-gray-200 rounded-lg shadow py-12 px-6">
                    <div class="flex flex-col items-center gap-4">
                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m0 0l8 4m-8-4v10l8 4m0-10l8-4m-8 4v10l8-4m-8-4l8 4"></path>
                        </svg>
                        <p class="text-gray-500 text-lg font-medium">No rooms found</p>
                        <p class="text-gray-400 text-sm">Try adjusting your filters</p>
                    </div>
                </div>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($rooms->count() > 0)
        <div class="flex justify-center">
            {{ $rooms->links() }}
        </div>
    @endif
</div>
@endsection
