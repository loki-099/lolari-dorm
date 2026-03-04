@extends('staff.layouts.app')

@section('title', 'Rooms')

@section('content')
<div class="space-y-6">
    <!-- Filters -->
    <div class="bg-white rounded-lg shadow p-4">
        <form action="{{ route('staff.rooms.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <!-- Status Filter -->
            <div>
                <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                <select name="status" id="status" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                    <option value="">All Status</option>
                    @foreach(['available', 'occupied', 'maintenance'] as $s)
                        <option value="{{ $s }}" @selected(request('status') === $s)>{{ ucfirst($s) }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Type Filter -->
            <div>
                <label for="type" class="block text-sm font-medium text-gray-700 mb-1">Type</label>
                <select name="type" id="type" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                    <option value="">All Types</option>
                    @foreach(['single', 'double', 'triple'] as $t)
                        <option value="{{ $t }}" @selected(request('type') === $t)>{{ ucfirst($t) }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Filter Button -->
            <div class="flex items-end">
                <button type="submit" class="w-full px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium">
                    Filter
                </button>
            </div>
        </form>
    </div>

    <!-- Rooms Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @forelse($rooms as $room)
            <div class="bg-white rounded-lg shadow p-4 border-t-4 @if($room->status === 'available') border-green-500 @elseif($room->status === 'occupied') border-blue-500 @else border-red-500 @endif">
                <div class="flex justify-between items-start mb-3">
                    <div>
                        <h3 class="text-lg font-bold text-gray-900">Room {{ $room->number }}</h3>
                        <p class="text-sm text-gray-600 capitalize">{{ $room->type }}</p>
                    </div>
                    <span class="px-3 py-1 rounded-full text-xs font-medium
                        @if($room->status === 'available') bg-green-100 text-green-800
                        @elseif($room->status === 'occupied') bg-blue-100 text-blue-800
                        @else bg-red-100 text-red-800
                        @endif
                    ">
                        {{ ucfirst($room->status) }}
                    </span>
                </div>

                <div class="mb-4 pt-3 border-t border-gray-200">
                    <p class="text-xl font-bold text-gray-900">₱{{ number_format($room->price, 2) }}/month</p>
                </div>

                <a href="{{ route('staff.rooms.show', $room) }}" class="block text-center px-3 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg text-sm font-medium">
                    View Details
                </a>
            </div>
        @empty
            <div class="col-span-full text-center py-12">
                <p class="text-gray-500">No rooms found matching your filters</p>
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
