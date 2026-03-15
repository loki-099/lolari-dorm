@extends('layouts.admin')

@section('title', 'Transactions')

@section('content')
<div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 sm:p-6 dark:bg-gray-800">
    <!-- Header with Action Button -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
        <div>
            <h3 class="text-xl font-bold text-gray-900 dark:text-white">Transactions</h3>
            <p class="text-gray-500 dark:text-gray-400 text-sm mt-1">View and manage all payment transactions</p>
        </div>
        <a href="{{ route('admin.transactions.create') }}" class="inline-flex items-center justify-center gap-2 px-5 py-2.5 text-sm font-medium text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 rounded-lg dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            <span>New Transaction</span>
        </a>
    </div>

    <!-- Transactions Table -->
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">ID</th>
                    <th scope="col" class="px-6 py-3">Date</th>
                    <th scope="col" class="px-6 py-3">Boarder</th>
                    <th scope="col" class="px-6 py-3">Amount</th>
                    <th scope="col" class="px-6 py-3">Method</th>
                    <th scope="col" class="px-6 py-3">Status</th>
                    <th scope="col" class="px-6 py-3">Billing Month</th>
                    <th scope="col" class="px-6 py-3">Staff</th>
                    <th scope="col" class="px-6 py-3">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                @forelse($transactions as $transaction)
                    <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                        <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                            #{{ $transaction->id }}
                        </td>
                        <td class="px-6 py-4 text-gray-600 dark:text-gray-400">
                            {{ $transaction->created_at->format('M d, Y H:i') }}
                        </td>
                        <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                            {{ $transaction->boarder->user->first_name ?? 'N/A' }} {{ $transaction->boarder->user->last_name ?? '' }}
                        </td>
                        <td class="px-6 py-4">
                            <span class="text- font-semibold text-green-600 dark:text-green-400">₱{{ number_format($transaction->amount, 2) }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400 border border-blue-200 dark:border-blue-800">
                                {{ $transaction->payment_method === 'cash' ? 'Cash' : 'E-wallet' }}
                            </span>
                        </td>
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
                        <td class="px-6 py-4 text-gray-600 dark:text-gray-400">
                            {{ \Carbon\Carbon::parse($transaction->billing_month)->format('M Y') }}
                        </td>
                        <td class="px-6 py-4 text-gray-600 dark:text-gray-400">
                            {{ $transaction->staff->user->first_name ?? '-' }} {{ $transaction->staff->user->last_name ?? '' }}
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <a href="{{ route('admin.transactions.show', $transaction) }}" class="text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 font-medium transition-colors">View</a>
                                <a href="{{ route('admin.transactions.edit', $transaction) }}" class="text-green-600 dark:text-green-400 hover:text-green-800 dark:hover:text-green-300 font-medium transition-colors">Edit</a>
                                <form action="{{ route('admin.transactions.destroy', $transaction) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this transaction?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 dark:text-red-400 hover:text-red-800 dark:hover:text-red-300 font-medium transition-colors">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="px-6 py-8 text-center">
                            <div class="flex flex-col items-center gap-3">
                                <svg class="w-12 h-12 text-gray-400 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                <div>
                                    <p class="text-gray-600 dark:text-gray-400 font-medium">No transactions found</p>
                                    <p class="text-gray-500 dark:text-gray-500 text-sm mt-1">Get started by creating a new transaction</p>
                                </div>
                                <a href="{{ route('admin.transactions.create') }}" class="mt-4 inline-flex items-center justify-center gap-2 px-5 py-2.5 text-sm font-medium text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 rounded-lg dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                    </svg>
                                    Create First Transaction
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if(isset($transactions) && $transactions->count() > 0)
        <div class="mt-4">
            {{ $transactions->links() }}
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
    .pagination li { margin: 0; }
    .pagination a, .pagination span {
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
    .dark .pagination a, .dark .pagination span {
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

