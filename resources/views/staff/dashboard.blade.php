@extends('staff.layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="space-y-6">
    <!-- Stat Cards Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Occupancy Rate Card -->
        <div class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:shadow-lg transition-shadow">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <h5 class="text-gray-500 text-sm font-semibold uppercase tracking-wider">Occupancy Rate</h5>
                    <p class="text-3xl font-bold text-blue-600 mt-2">{{ $occupancyRate }}%</p>
                    <p class="text-xs text-gray-600 mt-1">{{ $occupiedRooms }}/{{ $totalRooms }} rooms occupied</p>
                </div>
                <div class="inline-flex items-center justify-center w-14 h-14 bg-blue-100 rounded-full">
                    <svg class="w-8 h-8 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10.5 1.5H5a1.5 1.5 0 00-1.5 1.5v3H1.5a1.5 1.5 0 00-1.5 1.5v10a1.5 1.5 0 001.5 1.5h17a1.5 1.5 0 001.5-1.5V7.5a1.5 1.5 0 00-1.5-1.5H13V3a1.5 1.5 0 00-1.5-1.5z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Pending Payments Card -->
        <div class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:shadow-lg transition-shadow">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <h5 class="text-gray-500 text-sm font-semibold uppercase tracking-wider">Pending Payments</h5>
                    <p class="text-3xl font-bold text-amber-600 mt-2">{{ $pendingPayments }}</p>
                    <p class="text-xs text-gray-600 mt-1">Awaiting completion</p>
                </div>
                <div class="inline-flex items-center justify-center w-14 h-14 bg-amber-100 rounded-full">
                    <svg class="w-8 h-8 text-amber-600" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Available Rooms Card -->
        <div class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:shadow-lg transition-shadow">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <h5 class="text-gray-500 text-sm font-semibold uppercase tracking-wider">Available Rooms</h5>
                    <p class="text-3xl font-bold text-green-600 mt-2">{{ $availableRooms }}</p>
                    <p class="text-xs text-gray-600 mt-1">Ready for assignment</p>
                </div>
                <div class="inline-flex items-center justify-center w-14 h-14 bg-green-100 rounded-full">
                    <svg class="w-8 h-8 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M13 7H7v6h6V7z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions Card -->
    <div class="p-6 bg-white border border-gray-200 rounded-lg shadow">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Quick Actions</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <!-- New Boarder Button -->
            <a href="{{ route('staff.boarders.create') }}" class="inline-flex items-center justify-center gap-2 px-5 py-3 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                </svg>
                <span>New Boarder</span>
            </a>

            <!-- Log Payment Button -->
            <a href="{{ route('staff.payments.create') }}" class="inline-flex items-center justify-center gap-2 px-5 py-3 text-sm font-medium text-white bg-green-600 border border-transparent rounded-lg hover:bg-green-700 focus:ring-4 focus:ring-green-300 transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span>Log Payment</span>
            </a>

            <!-- Assign Room Button -->
            <a href="{{ route('staff.rooms.assign-form') }}" class="inline-flex items-center justify-center gap-2 px-5 py-3 text-sm font-medium text-white bg-purple-600 border border-transparent rounded-lg hover:bg-purple-700 focus:ring-4 focus:ring-purple-300 transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                </svg>
                <span>Assign Room</span>
            </a>
        </div>
    </div>

    <!-- Recent Transactions Table -->
    <div class="p-6 bg-white border border-gray-200 rounded-lg shadow overflow-hidden">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Recent Transactions</h3>
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs font-semibold text-gray-700 uppercase bg-gray-50 boundary-b">
                    <tr>
                        <th scope="col" class="px-6 py-3">Date</th>
                        <th scope="col" class="px-6 py-3">Boarder</th>
                        <th scope="col" class="px-6 py-3">Amount</th>
                        <th scope="col" class="px-6 py-3">Method</th>
                        <th scope="col" class="px-6 py-3">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($recentTransactions as $transaction)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 font-medium text-gray-900">{{ $transaction->created_at->format('M d, Y') }}</td>
                            <td class="px-6 py-4 text-gray-900">{{ $transaction->boarder->name }}</td>
                            <td class="px-6 py-4 font-semibold text-gray-900">₱{{ number_format($transaction->amount, 2) }}</td>
                            <td class="px-6 py-4 text-gray-600">
                                <span class="capitalize">{{ str_replace('_', ' ', $transaction->payment_method) }}</span>
                            </td>
                            <td class="px-6 py-4">
                                @if($transaction->status === 'completed')
                                    <span class="inline-flex items-center px-3 py-1 text-xs font-medium text-green-800 bg-green-100 rounded-full">
                                        <span class="w-2 h-2 bg-green-500 rounded-full mr-2"></span>
                                        Completed
                                    </span>
                                @elseif($transaction->status === 'pending')
                                    <span class="inline-flex items-center px-3 py-1 text-xs font-medium text-amber-800 bg-amber-100 rounded-full">
                                        <span class="w-2 h-2 bg-amber-500 rounded-full mr-2"></span>
                                        Pending
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-3 py-1 text-xs font-medium text-red-800 bg-red-100 rounded-full">
                                        <span class="w-2 h-2 bg-red-500 rounded-full mr-2"></span>
                                        Failed
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-gray-500 text-sm">
                                <div class="flex items-center justify-center gap-2">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    No transactions yet
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
