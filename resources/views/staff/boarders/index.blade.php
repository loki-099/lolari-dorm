@extends('staff.layouts.app')

@section('title', 'Boarders')

@section('content')
<div class="space-y-6">
    <!-- Add New Button -->
    <div class="flex justify-end">
        <a href="{{ route('staff.boarders.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg">
            + New Boarder
        </a>
    </div>

    <!-- Boarders Table -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Contact</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Current Room</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($boarders as $boarder)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $boarder->name }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $boarder->contact ?? '-' }}</td>
                        <td class="px-6 py-4 text-sm">
                            <span class="px-2 py-1 rounded-full text-xs font-medium
                                @if($boarder->status === 'active') bg-green-100 text-green-800
                                @elseif($boarder->status === 'inactive') bg-gray-100 text-gray-800
                                @else bg-red-100 text-red-800
                                @endif
                            ">
                                {{ ucfirst($boarder->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600">
                            @php
                                $activeAssignment = $boarder->assignments->where('end_date', null)->first();
                            @endphp
                            {{ $activeAssignment?->room->number ?? '-' }}
                        </td>
                        <td class="px-6 py-4 text-sm space-x-2">
                            <a href="{{ route('staff.boarders.show', $boarder) }}" class="text-blue-600 hover:text-blue-800">View</a>
                            <a href="{{ route('staff.boarders.edit', $boarder) }}" class="text-green-600 hover:text-green-800">Edit</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-gray-500">No boarders yet</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="flex justify-center">
        {{ $boarders->links() }}
    </div>
</div>
@endsection
