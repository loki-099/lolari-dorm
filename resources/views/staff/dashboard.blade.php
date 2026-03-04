@extends('staff.layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="space-y-6">
    <!-- Stat Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Occupancy Rate Card -->
        <div class="bg-white rounded-lg shadow p-6 border-l-4 border-blue-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-medium">Occupancy Rate</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">{{ $occupancyRate }}%</p>
                    <p class="text-xs text-gray-500 mt-1">{{ $occupiedRooms }}/{{ $totalRooms }} rooms occupied</p>
                </div>
                <svg class="w-12 h-12 text-blue-100" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10.5 1.5H5a1.5 1.5 0 00-1.5 1.5v3H1.5a1.5 1.5 0 00-1.5 1.5v10a1.5 1.5 0 001.5 1.5h17a1.5 1.5 0 001.5-1.5V7.5a1.5 1.5 0 00-1.5-1.5H13V3a1.5 1.5 0 00-1.5-1.5z"></path>
                </svg>
            </div>
        </div>

        <!-- Pending Payments Card -->
        <div class="bg-white rounded-lg shadow p-6 border-l-4 border-yellow-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-medium">Pending Payments</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">{{ $pendingPayments }}</p>
                    <p class="text-xs text-gray-500 mt-1">Transactions awaiting completion</p>
                </div>
                <svg class="w-12 h-12 text-yellow-100" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4z"></path>
                </svg>
            </div>
        </div>

        <!-- Available Rooms Card -->
        <div class="bg-white rounded-lg shadow p-6 border-l-4 border-green-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-medium">Available Rooms</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">{{ $availableRooms }}</p>
                    <p class="text-xs text-gray-500 mt-1">Ready for assignment</p>
                </div>
                <svg class="w-12 h-12 text-green-100" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M13 7H7v6h6V7z"></path>
                </svg>
            </div>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Quick Actions</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <!-- New Boarder Button -->
            <a href="{{ route('staff.boarders.create') }}" class="flex items-center justify-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-4 rounded-lg transition">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M10.5 1.5H5a1.5 1.5 0 00-1.5 1.5v12a1.5 1.5 0 001.5 1.5h10a1.5 1.5 0 001.5-1.5V3a1.5 1.5 0 00-1.5-1.5zM7 9a1 1 0 100-2 1 1 0 000 2zm6 0a1 1 0 100-2 1 1 0 000 2z"></path></svg>
                <span>New Boarder</span>
            </a>

            <!-- Log Payment Button -->
            <a href="{{ route('staff.payments.create') }}" class="flex items-center justify-center gap-2 bg-green-600 hover:bg-green-700 text-white font-medium py-3 px-4 rounded-lg transition">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z"></path></svg>
                <span>Log Payment</span>
            </a>

            <!-- Assign Room Button -->
            <a href="{{ route('staff.rooms.assign-form') }}" class="flex items-center justify-center gap-2 bg-purple-600 hover:bg-purple-700 text-white font-medium py-3 px-4 rounded-lg transition">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M10.5 1.5H5a1.5 1.5 0 00-1.5 1.5v3H1.5a1.5 1.5 0 00-1.5 1.5v10a1.5 1.5 0 001.5 1.5h17a1.5 1.5 0 001.5-1.5V7.5a1.5 1.5 0 00-1.5-1.5H13V3a1.5 1.5 0 00-1.5-1.5z"></path></svg>
                <span>Assign Room</span>
            </a>
        </div>
    </div>

    <!-- Recent Transactions -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="p-6 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">Recent Transactions</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Boarder</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Amount</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Method</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($recentTransactions as $transaction)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 text-sm text-gray-900">{{ $transaction->created_at->format('M d, Y') }}</td>
                            <td class="px-6 py-4 text-sm text-gray-900">{{ $transaction->boarder->name }}</td>
                            <td class="px-6 py-4 text-sm font-medium text-gray-900">₱{{ number_format($transaction->amount, 2) }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">
                                <span class="capitalize">{{ str_replace('_', ' ', $transaction->payment_method) }}</span>
                            </td>
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
                            <td colspan="5" class="px-6 py-4 text-center text-gray-500">No transactions yet</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
