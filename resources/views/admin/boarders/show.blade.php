@extends('layouts.admin')

@section('title', $boarder->user->first_name . ' ' . $boarder->user->last_name)

@section('content')
<div class="space-y-6">
    <!-- Boarder Info Card -->
    <div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 sm:p-6 dark:bg-gray-800">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
            <div>
                <h2 class="text-3xl font-bold text-gray-900 dark:text-white">{{ $boarder->user->first_name }} {{ $boarder->user->last_name }}</h2>
                <div class="mt-2">
                    @if($boarder->status === 'active')
                        <span class="inline-flex items-center px-3 py-1 text-sm font-semibold text-green-800 bg-green-100 dark:bg-green-900/30 dark:text-green-400 rounded-full border border-green-200 dark:border-green-800">
                            <span class="w-2 h-2 bg-green-500 rounded-full mr-2"></span>
                            Active
                        </span>
                    @elseif($boarder->status === 'inactive')
                        <span class="inline-flex items-center px-3 py-1 text-sm font-semibold text-gray-800 bg-gray-100 dark:bg-gray-700 dark:text-gray-300 rounded-full border border-gray-200 dark:border-gray-600">
                            <span class="w-2 h-2 bg-gray-500 rounded-full mr-2"></span>
                            Inactive
                        </span>
                    @else
                        <span class="inline-flex items-center px-3 py-1 text-sm font-semibold text-red-800 bg-red-100 dark:bg-red-900/30 dark:text-red-400 rounded-full border border-red-200 dark:border-red-800">
                            <span class="w-2 h-2 bg-red-500 rounded-full mr-2"></span>
                            Suspended
                        </span>
                    @endif
                </div>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('admin.boarders.edit', $boarder) }}" class="inline-flex items-center gap-2 px-5 py-2.5 text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:ring-green-300 rounded-lg dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800 transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    Edit
                </a>
                @if(!$boarder->assignments()->whereNull('end_date')->exists())
                    <form action="{{ route('admin.boarders.destroy', $boarder) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this boarder? This action cannot be undone.');" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="inline-flex items-center gap-2 px-5 py-2.5 text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:ring-red-300 rounded-lg dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800 transition-all">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                            Delete
                        </button>
                    </form>
                @endif
            </div>
        </div>

        <!-- Contact Information Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 pt-6 border-t border-gray-200 dark:border-gray-600">
            <!-- Email -->
            <div class="bg-gray-50 dark:bg-gray-700/50 rounded-lg p-4">
                <div class="flex items-center gap-3">
                    <div class="flex-shrink-0">
                        <div class="w-10 h-10 bg-blue-100 dark:bg-blue-900/30 rounded-full flex items-center justify-center">
                            <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 dark:text-gray-400 font-semibold uppercase tracking-wider">Email</p>
                        <p class="text-sm font-medium text-gray-900 dark:text-white mt-1">{{ $boarder->user->email ?? '-' }}</p>
                    </div>
                </div>
            </div>

            <!-- Contact Number -->
            <div class="bg-gray-50 dark:bg-gray-700/50 rounded-lg p-4">
                <div class="flex items-center gap-3">
                    <div class="flex-shrink-0">
                        <div class="w-10 h-10 bg-green-100 dark:bg-green-900/30 rounded-full flex items-center justify-center">
                            <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                        </div>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 dark:text-gray-400 font-semibold uppercase tracking-wider">Contact</p>
                        <p class="text-sm font-medium text-gray-900 dark:text-white mt-1">{{ $boarder->contact ?? '-' }}</p>
                    </div>
                </div>
            </div>

            <!-- Parent Contact -->
            <div class="bg-gray-50 dark:bg-gray-700/50 rounded-lg p-4">
                <div class="flex items-center gap-3">
                    <div class="flex-shrink-0">
                        <div class="w-10 h-10 bg-purple-100 dark:bg-purple-900/30 rounded-full flex items-center justify-center">
                            <svg class="w-5 h-5 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 dark:text-gray-400 font-semibold uppercase tracking-wider">Parent/Guardian</p>
                        <p class="text-sm font-medium text-gray-900 dark:text-white mt-1">{{ $boarder->parent_contact ?? '-' }}</p>
                    </div>
                </div>
            </div>

            <!-- Home Address -->
            <div class="bg-gray-50 dark:bg-gray-700/50 rounded-lg p-4 md:col-span-2">
                <div class="flex items-center gap-3">
                    <div class="flex-shrink-0">
                        <div class="w-10 h-10 bg-amber-100 dark:bg-amber-900/30 rounded-full flex items-center justify-center">
                            <svg class="w-5 h-5 text-amber-600 dark:text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 dark:text-gray-400 font-semibold uppercase tracking-wider">Home Address</p>
                        <p class="text-sm font-medium text-gray-900 dark:text-white mt-1">{{ $boarder->home_address ?? '-' }}</p>
                    </div>
                </div>
            </div>

            <!-- Registered Date -->
            <div class="bg-gray-50 dark:bg-gray-700/50 rounded-lg p-4">
                <div class="flex items-center gap-3">
                    <div class="flex-shrink-0">
                        <div class="w-10 h-10 bg-cyan-100 dark:bg-cyan-900/30 rounded-full flex items-center justify-center">
                            <svg class="w-5 h-5 text-cyan-600 dark:text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 dark:text-gray-400 font-semibold uppercase tracking-wider">Registered</p>
                        <p class="text-sm font-medium text-gray-900 dark:text-white mt-1">{{ $boarder->created_at->format('M d, Y') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Current Assignment -->
    <div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 sm:p-6 dark:bg-gray-800">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Current Assignment</h3>
        @php
            $activeAssignment = $boarder->assignments->where('end_date', null)->first();
        @endphp

        @if($activeAssignment)
            <div class="bg-blue-50 dark:bg-blue-900/20 border-l-4 border-blue-500 rounded-lg p-4">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <div>
                        <p class="text-xs text-gray-600 dark:text-gray-400 font-semibold uppercase">Room</p>
                        <p class="text-2xl font-bold text-blue-600 dark:text-blue-400 mt-1">{{ $activeAssignment->room->number }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-600 dark:text-gray-400 font-semibold uppercase">Type</p>
                        <p class="text-lg font-semibold text-gray-900 dark:text-white mt-1 capitalize">{{ $activeAssignment->room->type }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-600 dark:text-gray-400 font-semibold uppercase">Monthly Rate</p>
                        <p class="text-lg font-bold text-green-600 dark:text-green-400 mt-1">₱{{ number_format($activeAssignment->room->price, 2) }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-600 dark:text-gray-400 font-semibold uppercase">Payment Due Day</p>
                        <p class="text-lg font-semibold text-gray-900 dark:text-white mt-1">{{ $activeAssignment->due_day }}{{ $activeAssignment->due_day == 1 ? 'st' : ($activeAssignment->due_day == 2 ? 'nd' : ($activeAssignment->due_day == 3 ? 'rd' : 'th')) }} of month</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-600 dark:text-gray-400 font-semibold uppercase">Occupy Date</p>
                        <p class="text-lg font-semibold text-gray-900 dark:text-white mt-1">{{ $activeAssignment->start_date->format('M d, Y') }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-600 dark:text-gray-400 font-semibold uppercase">End Date</p>
                        <p class="text-lg font-semibold text-gray-900 dark:text-white mt-1">{{ $activeAssignment->end_date ? $activeAssignment->end_date->format('M d, Y') : 'Indefinite' }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-600 dark:text-gray-400 font-semibold uppercase">Days Occupied</p>
                        <p class="text-lg font-semibold text-gray-900 dark:text-white mt-1">{{ $activeAssignment->start_date->diffInDays(now()) }}</p>
                    </div>
                </div>
            </div>
        @else
            <div class="bg-gray-50 dark:bg-gray-700/50 border border-gray-200 dark:border-gray-600 rounded-lg p-6 flex items-center justify-between">
                <div>
                    <p class="text-gray-700 dark:text-gray-300 font-medium">No active room assignment</p>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">This boarder needs to be assigned to a room</p>
                </div>
                <a href="{{ route('admin.rooms.assign-form', ['boarder' => $boarder->id]) }}" class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-white bg-blue-700 hover:bg-blue-800 rounded-lg dark:bg-blue-600 dark:hover:bg-blue-700 transition-all whitespace-nowrap">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Assign Room
                </a>
            </div>
        @endif
    </div>

    <!-- Assignment History -->
    <div class="bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 dark:bg-gray-800 overflow-hidden">
        <div class="p-4 border-b border-gray-200 dark:border-gray-700 sm:p-6">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Assignment History</h3>
        </div>
        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">Room</th>
                        <th scope="col" class="px-6 py-3">Start Date</th>
                        <th scope="col" class="px-6 py-3">End Date</th>
                        <th scope="col" class="px-6 py-3">Due Day</th>
                        <th scope="col" class="px-6 py-3">Duration</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse($boarder->assignments as $assignment)
                        <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                            <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">Room {{ $assignment->room->number }}</td>
                            <td class="px-6 py-4">{{ $assignment->start_date->format('M d, Y') }}</td>
                            <td class="px-6 py-4">
                                @if($assignment->end_date)
                                    {{ $assignment->end_date->format('M d, Y') }}
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 text-xs font-medium text-blue-800 bg-blue-100 dark:bg-blue-900/30 dark:text-blue-400 rounded-full">
                                        Ongoing
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4">{{ $assignment->due_day }}{{ $assignment->due_day == 1 ? 'st' : ($assignment->due_day == 2 ? 'nd' : ($assignment->due_day == 3 ? 'rd' : 'th')) }}</td>
                            <td class="px-6 py-4">
                                @if($assignment->end_date)
                                    {{ $assignment->start_date->diffInDays($assignment->end_date) }} days
                                @else
                                    {{ $assignment->start_date->diffInDays(now()) }} days
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-8 text-center">
                                <div class="flex flex-col items-center gap-2">
                                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                                    </svg>
                                    <p class="text-gray-500">No assignment history</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Payment History -->
    <div class="bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 dark:bg-gray-800 overflow-hidden">
        <div class="p-4 border-b border-gray-200 dark:border-gray-700 sm:p-6">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Payment History</h3>
        </div>
        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">Date</th>
                        <th scope="col" class="px-6 py-3">Amount</th>
                        <th scope="col" class="px-6 py-3">Method</th>
                        <th scope="col" class="px-6 py-3">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse($boarder->transactions as $transaction)
                        <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                            <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">{{ $transaction->created_at->format('M d, Y') }}</td>
                            <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">₱{{ number_format($transaction->amount, 2) }}</td>
                            <td class="px-6 py-4 text-gray-600 dark:text-gray-400 capitalize">{{ str_replace('_', ' ', $transaction->payment_method) }}</td>
                            <td class="px-6 py-4">
                                @if($transaction->status === 'completed')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400 border border-green-200 dark:border-green-800">
                                        <span class="w-1.5 h-1.5 bg-green-500 rounded-full mr-1.5"></span>
                                        Completed
                                    </span>
                                @elseif($transaction->status === 'pending')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-100 text-amber-800 dark:bg-amber-900/30 dark:text-amber-400 border border-amber-200 dark:border-amber-800">
                                        <span class="w-1.5 h-1.5 bg-amber-500 rounded-full mr-1.5"></span>
                                        Pending
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400 border border-red-200 dark:border-red-800">
                                        <span class="w-1.5 h-1.5 bg-red-500 rounded-full mr-1.5"></span>
                                        Failed
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-8 text-center">
                                <div class="flex flex-col items-center gap-2">
                                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    <p class="text-gray-500">No transactions yet</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Back Button -->
    <div class="flex gap-3">
        <a href="{{ route('admin.boarders.index') }}" class="inline-flex items-center gap-2 px-5 py-2.5 text-sm font-medium text-gray-900 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:ring-4 focus:ring-gray-300 dark:bg-gray-700 dark:text-white dark:border-gray-600 dark:hover:bg-gray-600 dark:focus:ring-gray-600 transition-all">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Back to Boarders
        </a>
    </div>
</div>
@endsection

