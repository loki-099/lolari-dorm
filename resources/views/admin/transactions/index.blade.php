@extends('layouts.admin')

@section('title', 'Transactions')

@section('content')
<div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 sm:p-6 dark:bg-gray-800">
    <!-- Header with Action Button -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
        <div>
            <h3 class="text-xl font-bold text-gray-900 dark:text-white">Transactions</h3>
            <p class="text-gray-500 dark:text-gray-400 text-sm mt-1">Manage all transactions and payment records</p>
        </div>
        <a href="{{ route('admin.transactions.create') }}" class="inline-flex items-center justify-center gap-2 px-5 py-2.5 text-sm font-medium text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 rounded-lg dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            <span>New Transaction</span>
        </a>
    </div>

    <!-- Filters -->
    <div class="mb-6">
        <form method="GET" action="{{ route('admin.transactions.index') }}" class="flex flex-wrap gap-4 items-end">
            <div class="flex-1 min-w-[150px]">
                <label for="search" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Search Boarder</label>
                <input type="text" name="search" id="search" value="{{ request('search') }}" placeholder="Search by name..." 
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            </div>
            <div class="min-w-[150px]">
                <label for="status" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Status</label>
                <select name="status" id="status" 
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="">All Statuses</option>
                    @foreach($statuses as $status)
                        <option value="{{ $status }}" {{ request('status') == $status ? 'selected' : '' }}>
                            {{ ucfirst($status) }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="min-w-[150px]">
                <label for="payment_method" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Payment Method</label>
                <select name="payment_method" id="payment_method" 
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="">All Methods</option>
                    @foreach($methods as $method)
                        <option value="{{ $method }}" {{ request('payment_method') == $method ? 'selected' : '' }}>
                            {{ ucfirst(str_replace('_', ' ', $method)) }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="flex gap-2">
                <button type="submit" class="px-4 py-2.5 text-sm font-medium text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 rounded-lg dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 transition-colors">
                    Filter
                </button>
                <a href="{{ route('admin.transactions.index') }}" class="px-4 py-2.5 text-sm font-medium text-gray-900 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700 transition-colors">
                    Clear
                </a>
            </div>
        </form>
    </div>

    <!-- Transactions Table -->
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">Date</th>
                    <th scope="col" class="px-6 py-3">Boarder</th>
                    <th scope="col" class="px-6 py-3">Amount</th>
                    <th scope="col" class="px-6 py-3">Payment Method</th>
                    <th scope="col" class="px-6 py-3">Billing Month</th>
                    <th scope="col" class="px-6 py-3">Processed By</th>
                    <th scope="col" class="px-6 py-3">Status</th>
                    <th scope="col" class="px-6 py-3">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                @forelse($transactions as $transaction)
                    <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                        <td class="px-6 py-4 text-gray-600 dark:text-gray-400">
                            {{ $transaction->created_at->format('M d, Y') }}
                            <span class="text-xs text-gray-500 dark:text-gray-500 block">{{ $transaction->created_at->format('h:i A') }}</span>
                        </td>
                        <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                            @if($transaction->boarder && $transaction->boarder->user)
                                {{ $transaction->boarder->user->first_name }} {{ $transaction->boarder->user->last_name }}
                            @else
                                -
                            @endif
                        </td>
                        <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                            ₱{{ number_format($transaction->amount, 2) }}
                        </td>
                        <td class="px-6 py-4 text-gray-600 dark:text-gray-400">
                            @if($transaction->payment_method === 'cash')
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400 border border-green-200 dark:border-green-800">
                                    Cash
                                </span>
                            @elseif($transaction->payment_method === 'e_wallet')
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400 border border-blue-200 dark:border-blue-800">
                                    E-wallet
                                </span>
                            @else
                                <span class="text-gray-500 dark:text-gray-500">-</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-gray-600 dark:text-gray-400">
                            {{ $transaction->billing_month ? $transaction->billing_month->format('M Y') : '-' }}
                        </td>
                        <td class="px-6 py-4 text-gray-600 dark:text-gray-400">
                            @if($transaction->staff && $transaction->staff->user)
                                {{ $transaction->staff->user->first_name ?? 'Staff' }}
                            @else
                                System
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            @if($transaction->status === 'completed')
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400 border border-green-200 dark:border-green-800">
                                    <span class="w-1.5 h-1.5 bg-green-500 rounded-full mr-1.5"></span>
                                    Completed
                                </span>
                            @elseif($transaction->status === 'pending')
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-400 border border-yellow-200 dark:border-yellow-800">
                                    <span class="w-1.5 h-1.5 bg-yellow-500 rounded-full mr-1.5"></span>
                                    Pending
                                </span>
                            @elseif($transaction->status === 'failed')
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400 border border-red-200 dark:border-red-800">
                                    <span class="w-1.5 h-1.5 bg-red-500 rounded-full mr-1.5"></span>
                                    Failed
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <a href="{{ route('admin.transactions.show', $transaction) }}" class="text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 font-medium transition-colors">View</a>
                                <a href="{{ route('admin.transactions.edit', $transaction) }}" class="text-green-600 dark:text-green-400 hover:text-green-800 dark:hover:text-green-300 font-medium transition-colors">Edit</a>
                                <form action="{{ route('admin.transactions.destroy', $transaction) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this transaction? This action cannot be undone.');" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 dark:text-red-400 hover:text-red-800 dark:hover:text-red-300 font-medium transition-colors">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="px-6 py-8 text-center">
                            <div class="flex flex-col items-center gap-3">
                                <svg class="w-12 h-12 text-gray-400 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                                </svg>
                                <div>
                                    <p class="text-gray-600 dark:text-gray-400 font-medium">No transactions found</p>
                                    <p class="text-gray-500 dark:text-gray-500 text-sm mt-1">Get started by creating a new transaction</p>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if($transactions->count() > 0)
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
        color:0;
        background-color: #2 #6b728d3748;
    }
</style>
@endsection

