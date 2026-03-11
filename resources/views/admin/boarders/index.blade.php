@extends('layouts.admin')

@section('title', 'Boarders')

@section('content')
<div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 sm:p-6 dark:bg-gray-800">
    <!-- Header with Action Button -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
        <div>
            <h3 class="text-xl font-bold text-gray-900 dark:text-white">Boarders</h3>
            <p class="text-gray-500 dark:text-gray-400 text-sm mt-1">Manage all boarders and their room assignments</p>
        </div>
        <a href="{{ route('admin.boarders.create') }}" class="inline-flex items-center justify-center gap-2 px-5 py-2.5 text-sm font-medium text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 rounded-lg dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            <span>New Boarder</span>
        </a>
    </div>

    <!-- Boarders Table -->
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">Name</th>
                    <th scope="col" class="px-6 py-3">Email</th>
                    <th scope="col" class="px-6 py-3">Contact</th>
                    <th scope="col" class="px-6 py-3">Home Address</th>
                    <th scope="col" class="px-6 py-3">Parent Contact</th>
                    <th scope="col" class="px-6 py-3">Status</th>
                    <th scope="col" class="px-6 py-3">Current Room</th>
                    <th scope="col" class="px-6 py-3">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                @forelse($boarders as $boarder)
                    <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                        <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                            <div>
                                <p class="text-base">{{ $boarder->user->first_name }} {{ $boarder->user->last_name }}</p>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-gray-600 dark:text-gray-400">
                            {{ $boarder->user->email ?? '-' }}
                        </td>
                        <td class="px-6 py-4 text-gray-600 dark:text-gray-400">
                            {{ $boarder->user->contact_number ?? '-' }}
                        </td>
                        <td class="px-6 py-4 text-gray-600 dark:text-gray-400">
                            {{ Str::limit($boarder->home_address, 30) ?? '-' }}
                        </td>
                        <td class="px-6 py-4 text-gray-600 dark:text-gray-400">
                            {{ $boarder->parent_contact ?? '-' }}
                        </td>
                        <td class="px-6 py-4">
                            @if($boarder->status === 'active')
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400 border border-green-200 dark:border-green-800">
                                    <span class="w-1.5 h-1.5 bg-green-500 rounded-full mr-1.5"></span>
                                    Active
                                </span>
                            @elseif($boarder->status === 'inactive')
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300 border border-gray-200 dark:border-gray-600">
                                    <span class="w-1.5 h-1.5 bg-gray-500 rounded-full mr-1.5"></span>
                                    Inactive
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400 border border-red-200 dark:border-red-800">
                                    <span class="w-1.5 h-1.5 bg-red-500 rounded-full mr-1.5"></span>
                                    Suspended
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            @php
                                $activeAssignment = $boarder->assignments()
                                    ->where(function($q) {
                                        $q->whereNull('end_date')->orWhere('end_date', '>=', now());
                                    })
                                    ->latest('start_date')
                                    ->first();
                            @endphp
                            @if($activeAssignment)
                                <span class="font-semibold text-gray-900 dark:text-white">Room {{ $activeAssignment->room->number }}</span>
                            @else
                                <span class="text-gray-500 dark:text-gray-500">-</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <a href="{{ route('admin.boarders.show', $boarder) }}" class="text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 font-medium transition-colors">View</a>
                                <a href="{{ route('admin.boarders.edit', $boarder) }}" class="text-green-600 dark:text-green-400 hover:text-green-800 dark:hover:text-green-300 font-medium transition-colors">Edit</a>
                                @if(!$boarder->assignments()->where(function($q) { $q->whereNull('end_date')->orWhere('end_date', '>=', now()); })->exists())
                                    <form action="{{ route('admin.boarders.destroy', $boarder) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this boarder? This action cannot be undone.');" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 dark:text-red-400 hover:text-red-800 dark:hover:text-red-300 font-medium transition-colors">Delete</button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="px-6 py-8 text-center">
                            <div class="flex flex-col items-center gap-3">
                                <svg class="w-12 h-12 text-gray-400 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.856-1.487M15 10a3 3 0 11-6 0 3 3 0 016 0zM6 20a9 9 0 0118 0v2h2v-2a11 11 0 10-20 0v2h2v-2z"></path>
                                </svg>
                                <div>
                                    <p class="text-gray-600 dark:text-gray-400 font-medium">No boarders found</p>
                                    <p class="text-gray-500 dark:text-gray-500 text-sm mt-1">Get started by creating a new boarder</p>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if($boarders->count() > 0)
        <div class="mt-4">
            {{ $boarders->links() }}
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
</style>
@endsection

