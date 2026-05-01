@extends('layouts.admin')

@section('title', 'Expense Details')

@section('content')
<div class="space-y-6">
    @if (session('success'))
        <div class="rounded-lg border border-gray-200 bg-gray-50 p-4 text-sm text-gray-700 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="rounded-lg border border-gray-200 bg-gray-50 p-4 text-sm text-gray-700 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300">
            {{ session('error') }}
        </div>
    @endif

    <div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 sm:p-6 dark:bg-gray-800 mt-2">
        <div class="flex flex-col gap-4 md:flex-row md:items-start md:justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Expense #{{ $expense->id }}</h1>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Detailed expense information and metadata.</p>
            </div>
            <div class="flex flex-wrap gap-2 self-start md:self-auto">
                <a href="{{ route('admin.expenses.edit', $expense) }}" class="inline-flex items-center gap-2 rounded-lg bg-blue-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-500 dark:focus:ring-gray-600">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    Edit
                </a>
                <a href="{{ route('admin.expenses.index') }}" class="text-gray-900 bg-white border border-gray-300 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-gray-700 dark:text-white dark:border-gray-600 dark:hover:bg-gray-600 dark:hover:border-gray-600 dark:focus:ring-gray-600 inline-flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Back to list
                </a>
            </div>
        </div>
    </div>

    <div class="mt-6 grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
        <div class="rounded-lg bg-gray-50 p-4 dark:bg-gray-700/50">
            <p class="text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">Expense ID</p>
            <p class="mt-1 text-xl font-bold text-gray-900 dark:text-white">#{{ $expense->id }}</p>
        </div>
        <div class="rounded-lg bg-gray-50 p-4 dark:bg-gray-700/50">
            <p class="text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">Amount</p>
            <p class="mt-1 text-2xl font-bold text-gray-900 dark:text-white">₱{{ number_format($expense->amount, 2) }}</p>
        </div>
        <div class="rounded-lg bg-gray-50 p-4 dark:bg-gray-700/50">
            <p class="text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">Expense Type</p>
            <p class="mt-1">
                <span class="inline-flex items-center rounded-full border border-gray-200 bg-gray-100 px-2.5 py-0.5 text-xs font-medium text-gray-800 dark:border-gray-700 dark:bg-gray-700 dark:text-gray-200 capitalize">
                    {{ $expense->expense_type }}
                </span>
            </p>
        </div>
        <div class="rounded-lg bg-gray-50 p-4 dark:bg-gray-700/50">
            <p class="text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">Room</p>
            <p class="mt-1 text-lg font-bold text-gray-900 dark:text-white">Room {{ $expense->room->number ?? 'N/A' }}</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Expense Details Card -->
        <div class="group bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl shadow-sm hover:shadow-md transition-all duration-300 overflow-hidden">
            <div class="bg-gray-100 dark:bg-gray-700 p-6">
                <div class="flex items-center gap-3">
                    <div class="p-2 bg-white/20 rounded-lg">
                        <svg class="w-6 h-6 text-gray-900 dark:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white">Expense Details</h3>
                    </div>
                </div>
            </div>
            <div class="p-6 space-y-4">
                <div class="flex items-center gap-3 p-3 bg-gray-50 dark:bg-gray-700/50 rounded-lg">
                    <div class="p-2 bg-gray-100 dark:bg-gray-700 rounded-lg">
                        <svg class="w-5 h-5 text-gray-600 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Room</label>
                        <p class="font-semibold text-gray-900 dark:text-white">Room {{ $expense->room->number ?? 'N/A' }}</p>
                    </div>
                </div>
                <div class="flex items-center gap-3 p-3 bg-gray-50 dark:bg-gray-700/50 rounded-lg">
                    <div class="p-2 bg-gray-100 dark:bg-gray-700 rounded-lg">
                        <svg class="w-5 h-5 text-gray-600 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.991 1.991 0 013 12V7a4 4 0 014-4z"></path>
                        </svg>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Expense Type</label>
                        <p class="font-semibold text-gray-900 dark:text-white capitalize">{{ $expense->expense_type }}</p>
                    </div>
                </div>
                <div class="p-4 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl">
                    <div class="flex items-center justify-between">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Amount</label>
                            <p class="text-3xl font-bold text-gray-900 dark:text-white">₱{{ number_format($expense->amount, 2) }}</p>
                        </div>
                    </div>
                </div>
                <div class="flex items-center gap-3 p-3 bg-gray-50 dark:bg-gray-700/50 rounded-lg">
                    <div class="p-2 bg-gray-100 dark:bg-gray-700 rounded-lg">
                        <svg class="w-5 h-5 text-gray-600 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                        </svg>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Description</label>
                        <p class="font-semibold text-gray-900 dark:text-white">{{ $expense->description ?? 'No description' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Expense Info Card -->
        <div class="group bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl shadow-sm hover:shadow-md transition-all duration-300 overflow-hidden">
            <div class="bg-gray-100 dark:bg-gray-700 p-6">
                <div class="flex items-center gap-3">
                    <div class="p-2 bg-white/20 rounded-lg">
                        <svg class="w-6 h-6 text-gray-900 dark:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white">Expense Info</h3>
                        <p class="text-gray-600 dark:text-gray-400">When and by whom</p>
                    </div>
                </div>
            </div>
            <div class="p-6 space-y-4">
                <div class="flex items-center gap-3 p-3 bg-gray-50 dark:bg-gray-700/50 rounded-lg">
                    <div class="p-2 bg-gray-100 dark:bg-gray-700 rounded-lg">
                        <svg class="w-5 h-5 text-gray-600 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Expense Date</label>
                        <p class="font-semibold text-gray-900 dark:text-white">{{ $expense->expense_date->format('F d, Y') }}</p>
                    </div>
                </div>
                <div class="flex items-center gap-3 p-3 bg-gray-50 dark:bg-gray-700/50 rounded-lg">
                    <div class="p-2 bg-gray-100 dark:bg-gray-700 rounded-lg">
                        <svg class="w-5 h-5 text-gray-600 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Processed by</label>
                        <p class="font-semibold text-gray-900 dark:text-white">{{ $expense->staff->user->first_name ?? 'N/A' }} {{ $expense->staff->user->last_name ?? '' }}</p>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-3 pt-2">
                    <div class="text-center p-3">
                        <div class="text-sm text-gray-500 dark:text-gray-400 uppercase tracking-wide font-medium">Created</div>
                        <div class="text-sm text-gray-900 dark:text-white">{{ $expense->created_at->format('M d, Y H:i') }}</div>
                    </div>
                    <div class="text-center p-3">
                        <div class="text-sm text-gray-500 dark:text-gray-400 uppercase tracking-wide font-medium">Updated</div>
                        <div class="text-sm text-gray-900 dark:text-white">{{ $expense->updated_at->format('M d, Y H:i') }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
