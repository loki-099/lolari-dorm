@extends('staff.layouts.app')

@section('title', 'Payments')

@section('content')
<div class="space-y-6">
    <!-- Header with Action Button -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <p class="text-gray-600 dark:text-gray-400 text-sm">Track and manage all payment transactions</p>
        </div>
        <a href="{{ route('staff.payments.create') }}" class="inline-flex items-center justify-center gap-2 px-5 py-2.5 text-sm font-medium text-white bg-green-600 hover:bg-green-700 dark:bg-green-700 dark:hover:bg-green-800 border border-transparent rounded-lg transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            <span>Record Payment</span>
        </a>
    </div>

    <!-- Filters Card -->
    <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow p-4 md:p-6">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Filter Transactions</h3>
        <form action="{{ route('staff.payments.index') }}" method="GET" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <!-- Status Filter -->
            <div>
                <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Status</label>
                <select name="status" id="status" class="w-full px-4 py-2 text-sm text-gray-900 dark:text-white dark:bg-gray-700 bg-white border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-600 dark:focus:ring-blue-500 focus:border-transparent">
                    <option value="">All Status</option>
                    @foreach(['pending', 'completed', 'failed'] as $s)
                        <option value="{{ $s }}" @selected(request('status') === $s)>{{ ucfirst($s) }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Method Filter -->
            <div>
                <label for="method" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Payment Method</label>
                <select name="method" id="method" class="w-full px-4 py-2 text-sm text-gray-900 dark:text-white dark:bg-gray-700 bg-white border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-600 dark:focus:ring-blue-500 focus:border-transparent">
                    <option value="">All Methods</option>
                    @foreach(['cash', 'bank_transfer', 'check'] as $m)
                        <option value="{{ $m }}" @selected(request('method') === $m)>{{ str_replace('_', ' ', ucfirst($m)) }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Filter Button -->
            <div class="flex items-end gap-2">
                <button type="submit" class="px-5 py-2.5 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 dark:bg-blue-700 dark:hover:bg-blue-800 border border-transparent rounded-lg transition-colors w-full sm:w-auto">
                    Apply Filters
                </button>
                @if(request()->hasAny(['status', 'method']))
                    <a href="{{ route('staff.payments.index') }}" class="px-4 py-2.5 text-sm font-medium text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 border border-gray-300 dark:border-gray-600 rounded-lg transition-colors">
                        Clear
                    </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Transactions Table -->
    <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-600 dark:text-gray-400">
                <thead class="text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase bg-gray-50 dark:bg-gray-700 border-b border-gray-200 dark:border-gray-600">
                    <tr>
                        <th scope="col" class="px-6 py-3">Date</th>
                        <th scope="col" class="px-6 py-3 hidden sm:table-cell">Boarder</th>
                        <th scope="col" class="px-6 py-3">Amount</th>
                        <th scope="col" class="px-6 py-3 hidden md:table-cell">Method</th>
                        <th scope="col" class="px-6 py-3 hidden lg:table-cell">Staff</th>
                        <th scope="col" class="px-6 py-3">Status</th>
                        <th scope="col" class="px-6 py-3">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse($transactions as $transaction)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                            <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">{{ $transaction->created_at->format('M d, Y') }}</td>
                            <td class="px-6 py-4 font-medium text-gray-900 dark:text-white hidden sm:table-cell">
                                <div>
                                    <p>{{ $transaction->boarder->name }}</p>
                                    <p class="sm:hidden text-xs text-gray-600 dark:text-gray-400">{{ $transaction->payment_method }}</p>
                                </div>
                            </td>
                            <td class="px-6 py-4 font-semibold text-green-600 dark:text-green-400">₱{{ number_format($transaction->amount, 2) }}</td>
                            <td class="px-6 py-4 text-gray-600 dark:text-gray-400 hidden md:table-cell">{{ str_replace('_', ' ', ucfirst($transaction->payment_method)) }}</td>
                            <td class="px-6 py-4 text-gray-600 dark:text-gray-400 hidden lg:table-cell">{{ $transaction->staff->name }}</td>
                            <td class="px-6 py-4">
                                @if($transaction->status === 'completed')
                                    <span class="inline-flex items-center px-3 py-1 text-xs font-medium text-green-800 dark:text-green-300 bg-green-100 dark:bg-green-900/30 rounded-full border border-green-200 dark:border-green-800">
                                        <span class="w-2 h-2 bg-green-500 rounded-full mr-2"></span>
                                        Completed
                                    </span>
                                @elseif($transaction->status === 'pending')
                                    <span class="inline-flex items-center px-3 py-1 text-xs font-medium text-amber-800 dark:text-amber-300 bg-amber-100 dark:bg-amber-900/30 rounded-full border border-amber-200 dark:border-amber-800">
                                        <span class="w-2 h-2 bg-amber-500 rounded-full mr-2"></span>
                                        Pending
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-3 py-1 text-xs font-medium text-red-800 dark:text-red-300 bg-red-100 dark:bg-red-900/30 rounded-full border border-red-200 dark:border-red-800">
                                        <span class="w-2 h-2 bg-red-500 rounded-full mr-2"></span>
                                        Failed
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <a href="{{ route('staff.payments.show', $transaction) }}" class="text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 font-medium transition-colors">View</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-8 text-center">
                                <div class="flex flex-col items-center gap-3">
                                    <svg class="w-10 h-10 text-gray-400 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    <p class="text-gray-600 dark:text-gray-400">No transactions found</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    @if($transactions->count() > 0)
        <div class="flex justify-center">
            {{ $transactions->links() }}
        </div>
    @endif

    <!-- Note for Staff -->
    <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg p-4 flex gap-3">
        <svg class="w-5 h-5 text-blue-600 dark:text-blue-400 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M18 5v8a2 2 0 01-2 2h-5l-5 4v-4H4a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2zm-11-1a1 1 0 11-2 0 1 1 0 012 0zM10 9a1 1 0 100-2 1 1 0 000 2zm3 1a1 1 0 110-2 1 1 0 010 2z" clip-rule="evenodd"></path>
        </svg>
        <p class="text-sm text-blue-800 dark:text-blue-300">
            <strong>Note:</strong> You can view transaction details, but cannot edit or delete transaction records. Contact administration for refunds or corrections.
        </p>
    </div>
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
</style>@endsection