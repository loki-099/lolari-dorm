@extends('staff.layouts.app')

@section('title', $boarder->name)

@section('content')
<div class="space-y-6">
    <!-- Boarder Info Card -->
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex justify-between items-start mb-4">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">{{ $boarder->name }}</h2>
                <p class="text-gray-600 mt-1">Status: <span class="font-medium px-2 py-1 rounded-full text-xs
                    @if($boarder->status === 'active') bg-green-100 text-green-800
                    @elseif($boarder->status === 'inactive') bg-gray-100 text-gray-800
                    @else bg-red-100 text-red-800
                    @endif
                ">{{ ucfirst($boarder->status) }}</span></p>
            </div>
            <a href="{{ route('staff.boarders.edit', $boarder) }}" class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg">
                Edit
            </a>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 gap-4 pt-4 border-t border-gray-200">
            <div>
                <p class="text-sm text-gray-600">Contact</p>
                <p class="font-medium text-gray-900">{{ $boarder->contact ?? '-' }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-600">Documents</p>
                <p class="font-medium text-gray-900">{{ $boarder->documents_path ?? '-' }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-600">Created</p>
                <p class="font-medium text-gray-900">{{ $boarder->created_at->format('M d, Y') }}</p>
            </div>
        </div>
    </div>

    <!-- Current Assignment -->
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Current Assignment</h3>
        @php
            $activeAssignment = $boarder->assignments->where('end_date', null)->first();
        @endphp

        @if($activeAssignment)
            <div class="grid grid-cols-2 md:grid-cols-3 gap-4 p-4 bg-blue-50 rounded-lg border border-blue-200">
                <div>
                    <p class="text-sm text-gray-600">Room</p>
                    <p class="font-medium text-gray-900">{{ $activeAssignment->room->number }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Type</p>
                    <p class="font-medium text-gray-900 capitalize">{{ $activeAssignment->room->type }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Monthly Rate</p>
                    <p class="font-medium text-gray-900">₱{{ number_format($activeAssignment->room->price, 2) }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Start Date</p>
                    <p class="font-medium text-gray-900">{{ $activeAssignment->start_date->format('M d, Y') }}</p>
                </div>
                <div class="col-span-2 md:col-span-1">
                    <p class="text-sm text-gray-600">Duration</p>
                    <p class="font-medium text-gray-900">{{ $activeAssignment->start_date->diffInDays(now()) }} days</p>
                </div>
            </div>
        @else
            <div class="p-4 bg-gray-50 rounded-lg border border-gray-200">
                <p class="text-gray-600">No active room assignment</p>
                <a href="{{ route('staff.rooms.assign-form', ['boarder' => $boarder->id]) }}" class="inline-block mt-2 text-blue-600 hover:text-blue-800 font-medium">
                    Assign Room →
                </a>
            </div>
        @endif
    </div>

    <!-- Assignment History -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="p-6 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">Assignment History</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Room</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Start Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">End Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Duration</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($boarder->assignments as $assignment)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $assignment->room->number }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $assignment->start_date->format('M d, Y') }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $assignment->end_date?->format('M d, Y') ?? 'Ongoing' }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">
                                @if($assignment->end_date)
                                    {{ $assignment->start_date->diffInDays($assignment->end_date) }} days
                                @else
                                    {{ $assignment->start_date->diffInDays(now()) }} days
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center text-gray-500">No assignment history</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Transaction History -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="p-6 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">Payment History</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Amount</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Method</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($boarder->transactions as $transaction)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 text-sm text-gray-900">{{ $transaction->created_at->format('M d, Y') }}</td>
                            <td class="px-6 py-4 text-sm font-medium text-gray-900">₱{{ number_format($transaction->amount, 2) }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ str_replace('_', ' ', ucfirst($transaction->payment_method)) }}</td>
                            <td class="px-6 py-4 text-sm">
                                <span class="px-2 py-1 rounded-full text-xs font-medium
                                    @if($transaction->status === 'completed') bg-green-100 text-green-800
                                    @elseif($transaction->status === 'pending') bg-yellow-100 text-yellow-800
                                    @else bg-red-100 text-red-800
                                    @endif
                                ">
                                    {{ ucfirst($transaction->status) }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center text-gray-500">No transactions yet</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="flex gap-3">
        <a href="{{ route('staff.boarders.index') }}" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
            ← Back to Boarders
        </a>
    </div>
</div>
@endsection
