@extends('staff.layouts.app')

@section('title', $boarder->name)

@section('content')
<div class="space-y-6">
    <!-- Boarder Info Card -->
    <div class="bg-white border border-gray-200 rounded-lg shadow-md p-6">
        <div class="flex justify-between items-start mb-6">
            <div>
                <h2 class="text-3xl font-bold text-gray-900">{{ $boarder->name }}</h2>
                <div class="mt-2">
                    @if($boarder->status === 'active')
                        <span class="inline-flex items-center px-3 py-1 text-sm font-semibold text-green-800 bg-green-100 rounded-full">
                            <span class="w-2 h-2 bg-green-500 rounded-full mr-2"></span>
                            Active
                        </span>
                    @elseif($boarder->status === 'inactive')
                        <span class="inline-flex items-center px-3 py-1 text-sm font-semibold text-gray-800 bg-gray-100 rounded-full">
                            <span class="w-2 h-2 bg-gray-500 rounded-full mr-2"></span>
                            Inactive
                        </span>
                    @else
                        <span class="inline-flex items-center px-3 py-1 text-sm font-semibold text-red-800 bg-red-100 rounded-full">
                            <span class="w-2 h-2 bg-red-500 rounded-full mr-2"></span>
                            Suspended
                        </span>
                    @endif
                </div>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('staff.boarders.edit', $boarder) }}" class="inline-flex items-center gap-2 px-5 py-2.5 text-sm font-medium text-white bg-green-600 border border-transparent rounded-lg hover:bg-green-700 focus:ring-4 focus:ring-green-300 transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    Edit
                </a>
                @if(!$boarder->assignments()->whereNull('end_date')->exists())
                    <form action="{{ route('staff.boarders.destroy', $boarder) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this boarder? This action cannot be undone.');" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="inline-flex items-center gap-2 px-5 py-2.5 text-sm font-medium text-white bg-red-600 border border-transparent rounded-lg hover:bg-red-700 focus:ring-4 focus:ring-red-300 transition-all">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                            Delete
                        </button>
                    </form>
                @endif
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 pt-6 border-t border-gray-200">
            <div class="bg-gray-50 rounded-lg p-4">
                <p class="text-xs text-gray-500 font-semibold uppercase tracking-wider">Contact</p>
                <p class="text-lg font-semibold text-gray-900 mt-2">{{ $boarder->contact ?? '-' }}</p>
            </div>
            <div class="bg-gray-50 rounded-lg p-4">
                <p class="text-xs text-gray-500 font-semibold uppercase tracking-wider">Documents</p>
                <p class="text-lg font-semibold text-gray-900 mt-2 truncate" title="{{ $boarder->documents_path ?? 'N/A' }}">{{ Str::limit($boarder->documents_path, 20) ?? '-' }}</p>
            </div>
            <div class="bg-gray-50 rounded-lg p-4">
                <p class="text-xs text-gray-500 font-semibold uppercase tracking-wider">Registered</p>
                <p class="text-lg font-semibold text-gray-900 mt-2">{{ $boarder->created_at->format('M d, Y') }}</p>
            </div>
        </div>
    </div>

    <!-- Current Assignment -->
    <div class="bg-white border border-gray-200 rounded-lg shadow-md p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Current Assignment</h3>
        @php
            $activeAssignment = $boarder->assignments->where('status', 'active')->sortByDesc('start_date')->first();
        @endphp

        @if($activeAssignment)
            <div class="bg-blue-50 border-l-4 border-blue-500 rounded-lg p-4">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <div>
                        <p class="text-xs text-gray-600 font-semibold uppercase">Room</p>
                        <p class="text-2xl font-bold text-blue-600 mt-1">{{ $activeAssignment->room->number }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-600 font-semibold uppercase">Type</p>
                        <p class="text-lg font-semibold text-gray-900 mt-1 capitalize">{{ $activeAssignment->room->type }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-600 font-semibold uppercase">Monthly Rate</p>
                        <p class="text-lg font-bold text-green-600 mt-1">₱{{ number_format($activeAssignment->room->monthly_rent, 2) }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-600 font-semibold uppercase">Occupy Date</p>
                        <p class="text-lg font-semibold text-gray-900 mt-1">{{ $activeAssignment->start_date->format('M d, Y') }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-600 font-semibold uppercase">End Date</p>
                        <p class="text-lg font-semibold text-gray-900 mt-1">{{ $activeAssignment->end_date ? $activeAssignment->end_date->format('M d, Y') : 'Indefinite' }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-600 font-semibold uppercase">Days Occupied</p>
                        <p class="text-lg font-semibold text-gray-900 mt-1">{{ (int) $activeAssignment->start_date->startOfDay()->diffInDays(now()->startOfDay()) }}</p>
                    </div>
                </div>
            </div>
        @else
            <div class="bg-gray-50 border border-gray-200 rounded-lg p-6 flex items-center justify-between">
                <div>
                    <p class="text-gray-700 font-medium">No active room assignment</p>
                    <p class="text-sm text-gray-500 mt-1">This boarder needs to be assigned to a room</p>
                </div>
                <a href="{{ route('staff.rooms.assign-form', ['boarder' => $boarder->id]) }}" class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg transition-all whitespace-nowrap">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Assign Room
                </a>
            </div>
        @endif
    </div>

    <!-- Assignment History -->
    <div class="bg-white border border-gray-200 rounded-lg shadow-md overflow-hidden">
        <div class="p-6 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">Assignment History</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs font-semibold text-gray-700 uppercase bg-gray-50 border-b">
                    <tr>
                        <th scope="col" class="px-6 py-3">Room</th>
                        <th scope="col" class="px-6 py-3">Start Date</th>
                        <th scope="col" class="px-6 py-3">End Date</th>
                        <th scope="col" class="px-6 py-3">Duration</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($boarder->assignments as $assignment)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 font-medium text-gray-900">Room {{ $assignment->room->number }}</td>
                            <td class="px-6 py-4">{{ $assignment->start_date->format('M d, Y') }}</td>
                            <td class="px-6 py-4">
                                @if($assignment->end_date)
                                    {{ $assignment->end_date->format('M d, Y') }}
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 text-xs font-medium text-blue-800 bg-blue-100 rounded-full">
                                        Ongoing
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                @if($assignment->end_date)
                                    {{ (int) $assignment->start_date->startOfDay()->diffInDays($assignment->end_date->startOfDay()) }} days
                                @else
                                    {{ (int) $assignment->start_date->startOfDay()->diffInDays(now()->startOfDay()) }} days
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-8 text-center">
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
    <div class="bg-white border border-gray-200 rounded-lg shadow-md overflow-hidden">
        <div class="p-6 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">Payment History</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs font-semibold text-gray-700 uppercase bg-gray-50 border-b">
                    <tr>
                        <th scope="col" class="px-6 py-3">Date</th>
                        <th scope="col" class="px-6 py-3">Amount</th>
                        <th scope="col" class="px-6 py-3">Method</th>
                        <th scope="col" class="px-6 py-3">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($boarder->transactions as $transaction)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 font-medium text-gray-900">{{ $transaction->created_at->format('M d, Y') }}</td>
                            <td class="px-6 py-4 font-semibold text-gray-900">₱{{ number_format($transaction->amount, 2) }}</td>
                            <td class="px-6 py-4 text-gray-600 capitalize">{{ str_replace('_', ' ', $transaction->payment_method) }}</td>
                            <td class="px-6 py-4">
                                @if($transaction->status === 'completed')
                                    <span class="inline-flex items-center px-3 py-1 text-xs font-semibold text-green-800 bg-green-100 rounded-full">
                                        <span class="w-2 h-2 bg-green-500 rounded-full mr-2"></span>
                                        Completed
                                    </span>
                                @elseif($transaction->status === 'pending')
                                    <span class="inline-flex items-center px-3 py-1 text-xs font-semibold text-amber-800 bg-amber-100 rounded-full">
                                        <span class="w-2 h-2 bg-amber-500 rounded-full mr-2"></span>
                                        Pending
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-3 py-1 text-xs font-semibold text-red-800 bg-red-100 rounded-full">
                                        <span class="w-2 h-2 bg-red-500 rounded-full mr-2"></span>
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
        <a href="{{ route('staff.boarders.index') }}" class="inline-flex items-center gap-2 px-5 py-2.5 text-sm font-medium text-gray-900 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:ring-4 focus:ring-gray-300 transition-all">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Back to Boarders
        </a>
    </div>
</div>
@endsection
