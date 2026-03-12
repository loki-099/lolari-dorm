@extends('layouts.admin')

@section('title', 'Transaction Details')

@section('content')
<div class="space-y-6">
    <!-- Transaction Info Card -->
    <div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 sm:p-6 dark:bg-gray-800">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
            <div>
                <h2 class="text-3xl font-bold text-gray-900 dark:text-white">Transaction #{{ $transaction->id }}</h2>
                <div class="mt-2">
                    @if($transaction->status === 'completed')
                        <span class="inline-flex items-center px-3 py-1 text-sm font-semibold text-green-800 bg-green-100 dark:bg-green-900/30 dark:text-green-400 rounded-full border border-green-200 dark:border-green-800">
                            <span class="w-2 h-2 bg-green-500 rounded-full mr-2"></span>
                            Completed
                        </span>
                    @elseif($transaction->status === 'pending')
                        <span class="inline-flex items-center px-3 py-1 text-sm font-semibold text-yellow-800 bg-yellow-100 dark:bg-yellow-900/30 dark:text-yellow-400 rounded-full border border-yellow-200 dark:border-yellow-800">
                            <span class="w-2 h-2 bg-yellow-500 rounded-full mr-2"></span>
                            Pending
                        </span>
                    @else
                        <span class="inline-flex items-center px-3 py-1 text-sm font-semibold text-red-800 bg-red-100 dark:bg-red-900/30 dark:text-red-400 rounded-full border border-red-200 dark:border-red-800">
                            <span class="w-2 h-2 bg-red-500 rounded-full mr-2"></span>
                            Failed
                        </span>
                    @endif
                </div>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('admin.transactions.edit', $transaction) }}" class="inline-flex items-center gap-2 px-5 py-2.5 text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:ring-green-300 rounded-lg dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800 transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    Edit
                </a>
                <form action="{{ route('admin.transactions.destroy', $transaction) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this transaction? This action cannot be undone.');" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="inline-flex items-center gap-2 px-5 py-2.5 text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:ring-red-300 rounded-lg dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800 transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                        Delete
                    </button>
                </form>
            </div>
        </div>

        <!-- Transaction Details Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 pt-6 border-t border-gray-200 dark:border-gray-600">
            <!-- Boarder -->
            <div class="bg-gray-50 dark:bg-gray-700/50 rounded-lg p-4">
                <div class="flex items-center gap-3">
                    <div class="flex-shrink-0">
                        <div class="w-10 h-10 bg-blue-100 dark:bg-blue-900/30 rounded-full flex items-center justify-center">
                            <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 dark:text-gray-400 font-semibold uppercase tracking-wider">Boarder</p>
                        <p class="text-sm font-medium text-gray-900 dark:text-white mt-1">
                            @if($transaction->boarder && $transaction->boarder->user)
                                {{ $transaction->boarder->user->first_name }} {{ $transaction->boarder->user->last_name }}
                            @else
                                -
                            @endif
                        </p>
                    </div>
                </div>
            </div>

            <!-- Amount -->
            <div class="bg-gray-50 dark:bg-gray-700/50 rounded-lg p-4">
                <div class="flex items-center gap-3">
                    <div class="flex-shrink-0">
                        <div class="w-10 h-10 bg-green-100 dark:bg-green-900/30 rounded-full flex items-center justify-center">
                            <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 dark:text-gray-400 font-semibold uppercase tracking-wider">Amount</p>
                        <p class="text-lg font-bold text-green-600 dark:text-green-400 mt-1">₱{{ number_format($transaction->amount, 2) }}</p>
                    </div>
                </div>
            </div>

            <!-- Payment Method -->
            <div class="bg-gray-50 dark:bg-gray-700/50 rounded-lg p-4">
                <div class="flex items-center gap-3">
                    <div class="flex-shrink-0">
                        <div class="w-10 h-10 bg-purple-100 dark:bg-purple-900/30 rounded-full flex items-center justify-center">
                            <svg class="w-5 h-5 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                            </svg>
                        </div>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 dark:text-gray-400 font-semibold uppercase tracking-wider">Payment Method</p>
                        <p class="text-sm font-medium text-gray-900 dark:text-white mt-1 capitalize">
                            @if($transaction->payment_method === 'e_wallet')
                                E-wallet
                            @else
                                {{ $transaction->payment_method }}
                            @endif
                        </p>
                    </div>
                </div>
            </div>

            <!-- Billing Month -->
            <div class="bg-gray-50 dark:bg-gray-700/50 rounded-lg p-4">
                <div class="flex items-center gap-3">
                    <div class="flex-shrink-0">
                        <div class="w-10 h-10 bg-amber-100 dark:bg-amber-900/30 rounded-full flex items-center justify-center">
                            <svg class="w-5 h-5 text-amber-600 dark:text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 dark:text-gray-400 font-semibold uppercase tracking-wider">Billing Month</p>
                        <p class="text-sm font-medium text-gray-900 dark:text-white mt-1">{{ $transaction->billing_month ? $transaction->billing_month->format('M Y') : '-' }}</p>
                    </div>
                </div>
            </div>

            <!-- Processed By -->
            <div class="bg-gray-50 dark:bg-gray-700/50 rounded-lg p-4">
                <div class="flex items-center gap-3">
                    <div class="flex-shrink-0">
                        <div class="w-10 h-10 bg-cyan-100 dark:bg-cyan-900/30 rounded-full flex items-center justify-center">
                            <svg class="w-5 h-5 text-cyan-600 dark:text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 dark:text-gray-400 font-semibold uppercase tracking-wider">Processed By</p>
                        <p class="text-sm font-medium text-gray-900 dark:text-white mt-1">
                            @if($transaction->staff && $transaction->staff->user)
                                {{ $transaction->staff->user->first_name ?? 'Staff' }} {{ $transaction->staff->user->last_name ?? '' }}
                            @else
                                System
                            @endif
                        </p>
                    </div>
                </div>
            </div>

            <!-- Transaction Date -->
            <div class="bg-gray-50 dark:bg-gray-700/50 rounded-lg p-4">
                <div class="flex items-center gap-3">
                    <div class="flex-shrink-0">
                        <div class="w-10 h-10 bg-indigo-100 dark:bg-indigo-900/30 rounded-full flex items-center justify-center">
                            <svg class="w-5 h-5 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 dark:text-gray-400 font-semibold uppercase tracking-wider">Transaction Date</p>
                        <p class="text-sm font-medium text-gray-900 dark:text-white mt-1">{{ $transaction->created_at->format('M d, Y h:i A') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Last Updated -->
        @if($transaction->updated_at != $transaction->created_at)
        <div class="mt-4 pt-4 border-t border-gray-200 dark:border-gray-600">
            <p class="text-xs text-gray-500 dark:text-gray-400">
                Last updated: {{ $transaction->updated_at->format('M d, Y h:i A') }}
            </p>
        </div>
        @endif
    </div>

    <!-- Back Button -->
    <div class="flex gap-3">
        <a href="{{ route('admin.transactions.index') }}" class="inline-flex items-center gap-2 px-5 py-2.5 text-sm font-medium text-gray-900 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:ring-4 focus:ring-gray-300 dark:bg-gray-700 dark:text-white dark:border-gray-600 dark:hover dark:focus:ring:bg-gray-600-gray-600 transition-all">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Back to Transactions
        </a>
    </div>
</div>
@endsection

