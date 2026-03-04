@extends('staff.layouts.app')

@section('title', 'Boarders')

@section('content')
<div class="space-y-6">
    <!-- Add New Button -->
    <div class="flex justify-end">
        <a href="{{ route('staff.boarders.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 transition-all">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            <span>New Boarder</span>
        </a>
    </div>

    <!-- Boarders Table -->
    <div class="p-0 bg-white border border-gray-200 rounded-lg shadow overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs font-semibold text-gray-700 uppercase bg-gray-50 border-b">
                    <tr>
                        <th scope="col" class="px-6 py-3">Name</th>
                        <th scope="col" class="px-6 py-3">Contact</th>
                        <th scope="col" class="px-6 py-3">Status</th>
                        <th scope="col" class="px-6 py-3">Current Room</th>
                        <th scope="col" class="px-6 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($boarders as $boarder)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 font-medium text-gray-900">{{ $boarder->name }}</td>
                            <td class="px-6 py-4 text-gray-600">{{ $boarder->contact ?? '-' }}</td>
                            <td class="px-6 py-4">
                                @if($boarder->status === 'active')
                                    <span class="inline-flex items-center px-3 py-1 text-xs font-medium text-green-800 bg-green-100 rounded-full">
                                        <span class="w-2 h-2 bg-green-500 rounded-full mr-2"></span>
                                        Active
                                    </span>
                                @elseif($boarder->status === 'inactive')
                                    <span class="inline-flex items-center px-3 py-1 text-xs font-medium text-gray-800 bg-gray-100 rounded-full">
                                        <span class="w-2 h-2 bg-gray-500 rounded-full mr-2"></span>
                                        Inactive
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-3 py-1 text-xs font-medium text-red-800 bg-red-100 rounded-full">
                                        <span class="w-2 h-2 bg-red-500 rounded-full mr-2"></span>
                                        Suspended
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-gray-600">
                                @php
                                    $activeAssignment = $boarder->assignments->where('end_date', null)->first();
                                @endphp
                                @if($activeAssignment)
                                    <span class="font-semibold text-gray-900">{{ $activeAssignment->room->number }}</span>
                                @else
                                    <span class="text-gray-500">-</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 space-x-3 flex items-center gap-2">
                                <a href="{{ route('staff.boarders.show', $boarder) }}" class="text-blue-600 hover:text-blue-800 font-medium transition-colors">View</a>
                                <a href="{{ route('staff.boarders.edit', $boarder) }}" class="text-green-600 hover:text-green-800 font-medium transition-colors">Edit</a>
                                @if(!$boarder->assignments()->whereNull('end_date')->exists())
                                    <form action="{{ route('staff.boarders.destroy', $boarder) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this boarder? This action cannot be undone.');" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800 font-medium transition-colors">Delete</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-8 text-center">
                                <div class="flex flex-col items-center gap-3">
                                    <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.856-1.487M15 10a3 3 0 11-6 0 3 3 0 016 0zM6 20a9 9 0 0118 0v2h2v-2a11 11 0 10-20 0v2h2v-2z"></path>
                                    </svg>
                                    <p class="text-gray-500">No boarders found</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    @if($boarders->count() > 0)
        <div class="flex justify-center">
            {{ $boarders->links() }}
        </div>
    @endif
</div>
@endsection
