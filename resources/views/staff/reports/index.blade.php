@extends('staff.layouts.app')

@section('title', 'Reports')

@section('content')
<div class="space-y-6">
    <!-- Overview Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Total Revenue -->
        <div class="p-6 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow">
            <div class="flex items-center justify-between">
                <div>
                    <h5 class="text-gray-600 dark:text-gray-400 text-sm font-semibold uppercase tracking-wider">Total Revenue</h5>
                    <p class="text-3xl font-bold text-green-600 dark:text-green-400 mt-2">₱{{ number_format($totalRevenue ?? 0, 2) }}</p>
                    <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">All completed payments</p>
                </div>
                <div class="inline-flex items-center justify-center w-14 h-14 bg-green-100 dark:bg-green-900/30 rounded-full">
                    <svg class="w-8 h-8 text-green-600 dark:text-green-400" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Total Rooms -->
        <div class="p-6 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow">
            <div class="flex items-center justify-between">
                <div>
                    <h5 class="text-gray-600 dark:text-gray-400 text-sm font-semibold uppercase tracking-wider">Total Rooms</h5>
                    <p class="text-3xl font-bold text-blue-600 dark:text-blue-400 mt-2">{{ $totalRooms ?? 0 }}</p>
                    <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">Dormitory capacity</p>
                </div>
                <div class="inline-flex items-center justify-center w-14 h-14 bg-blue-100 dark:bg-blue-900/30 rounded-full">
                    <svg class="w-8 h-8 text-blue-600 dark:text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10.5 1.5H5a1.5 1.5 0 00-1.5 1.5v3H1.5a1.5 1.5 0 00-1.5 1.5v10a1.5 1.5 0 001.5 1.5h17a1.5 1.5 0 001.5-1.5V7.5a1.5 1.5 0 00-1.5-1.5H13V3a1.5 1.5 0 00-1.5-1.5z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Total Boarders -->
        <div class="p-6 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow">
            <div class="flex items-center justify-between">
                <div>
                    <h5 class="text-gray-600 dark:text-gray-400 text-sm font-semibold uppercase tracking-wider">Total Boarders</h5>
                    <p class="text-3xl font-bold text-purple-600 dark:text-purple-400 mt-2">{{ $totalBoarders ?? 0 }}</p>
                    <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">Active & inactive</p>
                </div>
                <div class="inline-flex items-center justify-center w-14 h-14 bg-purple-100 dark:bg-purple-900/30 rounded-full">
                    <svg class="w-8 h-8 text-purple-600 dark:text-purple-400" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Total Transactions -->
        <div class="p-6 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow">
            <div class="flex items-center justify-between">
                <div>
                    <h5 class="text-gray-600 dark:text-gray-400 text-sm font-semibold uppercase tracking-wider">Total Transactions</h5>
                    <p class="text-3xl font-bold text-orange-600 dark:text-orange-400 mt-2">{{ $totalTransactions ?? 0 }}</p>
                    <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">All recorded payments</p>
                </div>
                <div class="inline-flex items-center justify-center w-14 h-14 bg-orange-100 dark:bg-orange-900/30 rounded-full">
                    <svg class="w-8 h-8 text-orange-600 dark:text-orange-400" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"></path>
                        <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 1 1 0 000 2h.01a1 1 0 100 2H6a3 3 0 00-3 3v6a3 3 0 003 3h12a3 3 0 003-3V8a3 3 0 00-3-3h-.5a1 1 0 000-2h-.5a2 2 0 00-2 2v.667a3.966 3.966 0 01-.564 1.565 1 1 0 001.448 1.383c.766-.935 1.23-2.13 1.23-3.49V5a2 2 0 012-2 1 1 0 100-2 4 4 0 00-4 4v.667a3.966 3.966 0 01-.564 1.565 1 1 0 001.448 1.383c.766-.935 1.23-2.13 1.23-3.49V5zm16 16H4v-2a1 1 0 00-1-1v-1a1 1 0 00-1 1v1a1 1 0 001 1h16z" clip-rule="evenodd"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Revenue Breakdown -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Payment Status Summary -->
        <div class="p-6 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Payment Status Summary</h3>
            <div class="space-y-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                        <span class="text-gray-700 dark:text-gray-300">Completed Payments</span>
                    </div>
                    <div class="text-right">
                        <p class="font-semibold text-gray-900 dark:text-white">{{ $completedPayments ?? 0 }}</p>
                        <p class="text-xs text-gray-600 dark:text-gray-400">₱{{ number_format($completedAmount ?? 0, 2) }}</p>
                    </div>
                </div>
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-3 h-3 bg-amber-500 rounded-full"></div>
                        <span class="text-gray-700 dark:text-gray-300">Pending Payments</span>
                    </div>
                    <div class="text-right">
                        <p class="font-semibold text-gray-900 dark:text-white">{{ $pendingPayments ?? 0 }}</p>
                        <p class="text-xs text-gray-600 dark:text-gray-400">₱{{ number_format($pendingAmount ?? 0, 2) }}</p>
                    </div>
                </div>
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-3 h-3 bg-red-500 rounded-full"></div>
                        <span class="text-gray-700 dark:text-gray-300">Failed Payments</span>
                    </div>
                    <div class="text-right">
                        <p class="font-semibold text-gray-900 dark:text-white">{{ $failedPayments ?? 0 }}</p>
                        <p class="text-xs text-gray-600 dark:text-gray-400">₱{{ number_format($failedAmount ?? 0, 2) }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Payment Methods Summary -->
        <div class="p-6 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Payment Methods</h3>
            <div class="space-y-4">
                @php
                    $methods = [
                        'cash' => 'Cash',
                        'e_wallet' => 'E-wallet'
                    ];
                @endphp
                @foreach($methods as $key => $label)
                    <div class="flex items-center justify-between">
                        <span class="text-gray-700 dark:text-gray-300">{{ $label }}</span>
                        <div class="text-right">
                            <p class="font-semibold text-gray-900 dark:text-white">{{ $methodCounts[$key] ?? 0 }}</p>
                            <p class="text-xs text-gray-600 dark:text-gray-400">₱{{ number_format($methodAmounts[$key] ?? 0, 2) }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Room Status Report -->
    <div class="p-6 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Room Status Report</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="p-4 bg-gray-50 dark:bg-gray-700/50 rounded-lg">
                <div class="flex items-center justify-between mb-2">
                    <span class="text-gray-700 dark:text-gray-300 font-medium">Occupied</span>
                    <span class="text-2xl font-bold text-blue-600 dark:text-blue-400">{{ $occupiedRooms ?? 0 }}</span>
                </div>
                <div class="w-full bg-gray-300 dark:bg-gray-600 rounded-full h-2">
                    <div class="bg-blue-600 dark:bg-blue-400 h-2 rounded-full" style="width: {{ $occupancyPercentage ?? 0 }}%"></div>
                </div>
                <p class="text-xs text-gray-600 dark:text-gray-400 mt-2">{{ $occupancyPercentage ?? 0 }}% occupancy</p>
            </div>
            <div class="p-4 bg-gray-50 dark:bg-gray-700/50 rounded-lg">
                <div class="flex items-center justify-between mb-2">
                    <span class="text-gray-700 dark:text-gray-300 font-medium">Available</span>
                    <span class="text-2xl font-bold text-green-600 dark:text-green-400">{{ $availableRooms ?? 0 }}</span>
                </div>
                <div class="w-full bg-gray-300 dark:bg-gray-600 rounded-full h-2">
                    <div class="bg-green-600 dark:bg-green-400 h-2 rounded-full" style="width: {{ $availablePercentage ?? 0 }}%"></div>
                </div>
                <p class="text-xs text-gray-600 dark:text-gray-400 mt-2">{{ $availablePercentage ?? 0 }}% available</p>
            </div>
            <div class="p-4 bg-gray-50 dark:bg-gray-700/50 rounded-lg">
                <div class="flex items-center justify-between mb-2">
                    <span class="text-gray-700 dark:text-gray-300 font-medium">Maintenance</span>
                    <span class="text-2xl font-bold text-red-600 dark:text-red-400">{{ $maintenanceRooms ?? 0 }}</span>
                </div>
                <div class="w-full bg-gray-300 dark:bg-gray-600 rounded-full h-2">
                    <div class="bg-red-600 dark:bg-red-400 h-2 rounded-full" style="width: {{ $maintenancePercentage ?? 0 }}%"></div>
                </div>
                <p class="text-xs text-gray-600 dark:text-gray-400 mt-2">{{ $maintenancePercentage ?? 0 }}% in maintenance</p>
            </div>
        </div>
    </div>

    <!-- Boarder Status Report -->
    <div class="p-6 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Boarder Status Report</h3>
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-600 dark:text-gray-400">
                <thead class="text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase bg-gray-50 dark:bg-gray-700 border-b border-gray-200 dark:border-gray-600">
                    <tr>
                        <th scope="col" class="px-6 py-3">Status</th>
                        <th scope="col" class="px-6 py-3">Count</th>
                        <th scope="col" class="px-6 py-3">Percentage</th>
                        <th scope="col" class="px-6 py-3 hidden md:table-cell">Details</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-3 py-1 text-xs font-medium text-green-800 dark:text-green-300 bg-green-100 dark:bg-green-900/30 rounded-full border border-green-200 dark:border-green-800">
                                Active
                            </span>
                        </td>
                        <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">{{ $activeBoarders ?? 0 }}</td>
                        <td class="px-6 py-4">{{ $activeBoardersPercentage ?? 0 }}%</td>
                        <td class="px-6 py-4 hidden md:table-cell text-gray-600 dark:text-gray-400">Boarders currently residing</td>
                    </tr>
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-3 py-1 text-xs font-medium text-gray-800 dark:text-gray-300 bg-gray-100 dark:bg-gray-700 rounded-full border border-gray-200 dark:border-gray-600">
                                Inactive
                            </span>
                        </td>
                        <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">{{ $inactiveBoarders ?? 0 }}</td>
                        <td class="px-6 py-4">{{ $inactiveBoardersPercentage ?? 0 }}%</td>
                        <td class="px-6 py-4 hidden md:table-cell text-gray-600 dark:text-gray-400">Boarders on leave or departed</td>
                    </tr>
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-3 py-1 text-xs font-medium text-red-800 dark:text-red-300 bg-red-100 dark:bg-red-900/30 rounded-full border border-red-200 dark:border-red-800">
                                Suspended
                            </span>
                        </td>
                        <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">{{ $suspendedBoarders ?? 0 }}</td>
                        <td class="px-6 py-4">{{ $suspendedBoardersPercentage ?? 0 }}%</td>
                        <td class="px-6 py-4 hidden md:table-cell text-gray-600 dark:text-gray-400">Boarders with violations</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Export Options -->
    <div class="p-6 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Export Reports</h3>
        <div class="flex flex-col sm:flex-row gap-3">
            <button type="button" class="inline-flex items-center justify-center gap-2 px-5 py-2.5 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 dark:bg-blue-700 dark:hover:bg-blue-800 rounded-lg transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                </svg>
                Download as PDF
            </button>
            <button type="button" class="inline-flex items-center justify-center gap-2 px-5 py-2.5 text-sm font-medium text-white bg-green-600 hover:bg-green-700 dark:bg-green-700 dark:hover:bg-green-800 rounded-lg transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                </svg>
                Export as Excel
            </button>
            <button type="button" class="inline-flex items-center justify-center gap-2 px-5 py-2.5 text-sm font-medium text-white bg-purple-600 hover:bg-purple-700 dark:bg-purple-700 dark:hover:bg-purple-800 rounded-lg transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2m0 0V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2h2"></path>
                </svg>
                Print
            </button>
        </div>
    </div>
</div>
@endsection
