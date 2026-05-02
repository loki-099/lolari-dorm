@extends('layouts.admin')

@section('title', 'Financial Reports')

@section('content')
    <div class="space-y-6">
        <div class="flex flex-col gap-2 md:flex-row md:items-center md:justify-between">
            <div>
                <h1 class="text-2xl font-bold text-heading">Financial Reports</h1>
                <p class="text-sm text-gray-600 dark:text-gray-400">Detailed financial performance and business health metrics for the dormitory.</p>
            </div>
            <div class="flex flex-wrap gap-2">
                <button type="button" class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg">Download PDF</button>
                <button type="button" class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-medium text-white bg-green-600 hover:bg-green-700 rounded-lg">Export Excel</button>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-6 lg:grid-cols-4">
            <div class="p-6 bg-neutral-primary-soft border border-default rounded-base shadow-sm">
                <p class="text-sm font-semibold text-gray-500">Total Revenue</p>
                <p class="mt-4 text-3xl font-bold text-green-600">₱{{ number_format($totalRevenue ?? 0, 2) }}</p>
                <p class="mt-2 text-sm text-gray-600">Completed transaction revenue.</p>
            </div>
            <div class="p-6 bg-neutral-primary-soft border border-default rounded-base shadow-sm">
                <p class="text-sm font-semibold text-gray-500">Total Expenses</p>
                <p class="mt-4 text-3xl font-bold text-red-600">₱{{ number_format($totalExpenses ?? 0, 2) }}</p>
                <p class="mt-2 text-sm text-gray-600">All recorded operating expenses.</p>
            </div>
            <div class="p-6 bg-neutral-primary-soft border border-default rounded-base shadow-sm">
                <p class="text-sm font-semibold text-gray-500">Net Profit</p>
                <p class="mt-4 text-3xl font-bold text-heading">₱{{ number_format(max(0, ($totalRevenue ?? 0) - ($totalExpenses ?? 0)), 2) }}</p>
                <p class="mt-2 text-sm text-gray-600">Revenue minus expenses.</p>
            </div>
            <div class="p-6 bg-neutral-primary-soft border border-default rounded-base shadow-sm">
                <p class="text-sm font-semibold text-gray-500">Outstanding Receivables</p>
                <p class="mt-4 text-3xl font-bold text-amber-600">₱{{ number_format($outstandingReceivables ?? 0, 2) }}</p>
                <p class="mt-2 text-sm text-gray-600">Pending payments not yet closed.</p>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-6 xl:grid-cols-[2fr_1fr]">
            <div class="space-y-6">
                <div class="p-6 bg-neutral-primary-soft border border-default rounded-base shadow-sm">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-lg font-semibold text-heading">Revenue and Expenses Trend</h2>
                        <span class="text-sm text-gray-500">Last 12 months</span>
                    </div>
                    <div class="overflow-x-auto rounded-base border border-default bg-white p-4">
                        <table class="min-w-full text-sm text-left text-body">
                            <thead class="text-xs uppercase bg-neutral-tertiary text-gray-700">
                                <tr>
                                    <th class="px-4 py-3">Month</th>
                                    <th class="px-4 py-3">Revenue</th>
                                    <th class="px-4 py-3">Expenses</th>
                                    <th class="px-4 py-3">Net</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-default">
                                @foreach ($monthlySummary as $month)
                                    <tr>
                                        <td class="px-4 py-3">{{ $month['label'] }}</td>
                                        <td class="px-4 py-3 text-green-600">₱{{ number_format($month['revenue'], 2) }}</td>
                                        <td class="px-4 py-3 text-red-600">₱{{ number_format($month['expenses'], 2) }}</td>
                                        <td class="px-4 py-3 font-semibold">₱{{ number_format($month['revenue'] - $month['expenses'], 2) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
                    <div class="p-6 bg-neutral-primary-soft border border-default rounded-base shadow-sm">
                        <h3 class="text-base font-semibold text-heading mb-4">Payments by Status</h3>
                        <div class="space-y-4">
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-600">Completed</span>
                                <span class="text-sm font-semibold text-green-600">{{ $completedCount ?? 0 }} · ₱{{ number_format($totalRevenue ?? 0, 2) }}</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-600">Pending</span>
                                <span class="text-sm font-semibold text-amber-600">{{ $pendingCount ?? 0 }} · ₱{{ number_format($pendingAmount ?? 0, 2) }}</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-600">Failed</span>
                                <span class="text-sm font-semibold text-red-600">{{ $failedCount ?? 0 }} · ₱{{ number_format($failedAmount ?? 0, 2) }}</span>
                            </div>
                            <div class="flex items-center justify-between border-t border-default pt-4">
                                <span class="text-sm font-semibold text-heading">Overdue</span>
                                <span class="text-sm font-semibold text-red-700">₱{{ number_format($overdueReceivables ?? 0, 2) }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="p-6 bg-neutral-primary-soft border border-default rounded-base shadow-sm">
                        <h3 class="text-base font-semibold text-heading mb-4">Utility Bills</h3>
                        <div class="space-y-4">
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-600">Unpaid Utility Bills</span>
                                <span class="text-sm font-semibold text-amber-600">₱{{ number_format($utilityOutstanding ?? 0, 2) }}</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-600">Overdue Utility</span>
                                <span class="text-sm font-semibold text-red-600">₱{{ number_format($utilityOverdue ?? 0, 2) }}</span>
                            </div>
                            @foreach ($utilityByType as $type => $stats)
                                <div class="flex items-center justify-between">
                                    <span class="capitalize text-sm text-gray-600">{{ $type }}</span>
                                    <span class="text-sm font-semibold text-heading">{{ $stats->count }} · ₱{{ number_format($stats->total, 2) }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div class="space-y-6">
                <div class="p-6 bg-neutral-primary-soft border border-default rounded-base shadow-sm">
                    <h3 class="text-lg font-semibold text-heading mb-4">Payment Methods</h3>
                    <div class="space-y-3">
                        @php
                            $methodLabels = [
                                'cash' => 'Cash',
                                'bank_transfer' => 'Bank Transfer',
                                'check' => 'Check',
                                'online' => 'Online',
                            ];
                        @endphp
                        @foreach ($methodLabels as $key => $label)
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-600">{{ $label }}</span>
                                <span class="text-sm font-semibold text-heading">{{ number_format($paymentMethods[$key]->count ?? 0) }} · ₱{{ number_format($paymentMethods[$key]->total ?? 0, 2) }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="p-6 bg-neutral-primary-soft border border-default rounded-base shadow-sm">
                    <h3 class="text-lg font-semibold text-heading mb-4">Expense Categories</h3>
                    <div class="space-y-3">
                        @forelse ($expenseByType as $category)
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-600">{{ $category->expense_type }}</span>
                                <span class="text-sm font-semibold text-heading">{{ $category->count }} · ₱{{ number_format($category->total, 2) }}</span>
                            </div>
                        @empty
                            <p class="text-sm text-gray-600">No expense categories found.</p>
                        @endforelse
                    </div>
                </div>

                <div class="p-6 bg-neutral-primary-soft border border-default rounded-base shadow-sm">
                    <h3 class="text-lg font-semibold text-heading mb-4">Top Rooms by Revenue</h3>
                    <div class="space-y-3">
                        @forelse ($topRooms as $room)
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-600">Room {{ $roomNumbers[$room->room_id] ?? 'N/A' }}</span>
                                <span class="text-sm font-semibold text-heading">₱{{ number_format($room->total_amount, 2) }}</span>
                            </div>
                        @empty
                            <p class="text-sm text-gray-600">No room revenue data available.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-6 xl:grid-cols-2">
            <div class="p-6 bg-neutral-primary-soft border border-default rounded-base shadow-sm">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-heading">Recent Transactions</h3>
                    <span class="text-sm text-gray-500">Latest 10</span>
                </div>
                <div class="overflow-x-auto rounded-base border border-default bg-white">
                    <table class="min-w-full text-sm text-left text-body">
                        <thead class="text-xs uppercase bg-neutral-tertiary text-gray-700">
                            <tr>
                                <th class="px-4 py-3">Boarder</th>
                                <th class="px-4 py-3">Amount</th>
                                <th class="px-4 py-3">Method</th>
                                <th class="px-4 py-3">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-default">
                            @foreach ($latestTransactions as $transaction)
                                <tr>
                                    <td class="px-4 py-3">{{ $transaction->boarder?->user?->first_name ?? 'N/A' }} {{ $transaction->boarder?->user?->last_name ?? '' }}</td>
                                    <td class="px-4 py-3">₱{{ number_format($transaction->amount, 2) }}</td>
                                    <td class="px-4 py-3 capitalize">{{ str_replace('_', ' ', $transaction->payment_method) }}</td>
                                    <td class="px-4 py-3 capitalize">{{ $transaction->status }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="p-6 bg-neutral-primary-soft border border-default rounded-base shadow-sm">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-heading">Recent Expenses</h3>
                    <span class="text-sm text-gray-500">Latest 10</span>
                </div>
                <div class="overflow-x-auto rounded-base border border-default bg-white">
                    <table class="min-w-full text-sm text-left text-body">
                        <thead class="text-xs uppercase bg-neutral-tertiary text-gray-700">
                            <tr>
                                <th class="px-4 py-3">Type</th>
                                <th class="px-4 py-3">Amount</th>
                                <th class="px-4 py-3">Date</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-default">
                            @foreach ($latestExpenses as $expense)
                                <tr>
                                    <td class="px-4 py-3">{{ $expense->expense_type }}</td>
                                    <td class="px-4 py-3">₱{{ number_format($expense->amount, 2) }}</td>
                                    <td class="px-4 py-3">{{ optional($expense->expense_date)->format('M d, Y') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
