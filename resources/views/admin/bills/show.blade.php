@extends('layouts.admin')

@section('title', 'Bill Details')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 sm:p-6 dark:bg-gray-800 mt-2">
        <div class="flex items-center justify-between gap-4">
            <div class="flex items-center gap-4">
                <a href="{{ route('admin.bills.index') }}" class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </a>
                <div>
                    <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Bill Details</h1>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Room {{ $bill->room->number }} - {{ ucfirst($bill->type) }} Bill</p>
                </div>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('admin.bills.edit', $bill) }}" class="inline-flex items-center justify-center gap-2 rounded-lg bg-green-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-green-800 focus:ring-4 focus:ring-green-300 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    Edit
                </a>
                <form action="{{ route('admin.bills.destroy', $bill) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure? This cannot be undone.');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="inline-flex items-center justify-center gap-2 rounded-lg bg-red-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-red-800 focus:ring-4 focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                        Delete
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Bill Info Cards -->
    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
        <!-- Room Info -->
        <div class="rounded-lg border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800 p-6">
            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Room Number</p>
            <p class="mt-2 text-2xl font-bold text-gray-900 dark:text-white">{{ $bill->room->number }}</p>
        </div>

        <!-- Bill Type -->
        <div class="rounded-lg border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800 p-6">
            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Bill Type</p>
            @php
                $typeColors = [
                    'electricity' => ['bg' => 'bg-yellow-100', 'text' => 'text-yellow-800'],
                    'water' => ['bg' => 'bg-blue-100', 'text' => 'text-blue-800'],
                    'internet' => ['bg' => 'bg-purple-100', 'text' => 'text-purple-800'],
                ];
                $colors = $typeColors[$bill->type] ?? $typeColors['electricity'];
            @endphp
            <div class="mt-2">
                <span class="inline-flex items-center rounded-full border {{ $colors['bg'] }} px-3 py-1 text-sm font-semibold {{ $colors['text'] }}">
                    {{ ucfirst($bill->type) }}
                </span>
            </div>
        </div>

        <!-- Amount -->
        <div class="rounded-lg border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800 p-6">
            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Amount</p>
            <p class="mt-2 text-2xl font-bold text-gray-900 dark:text-white">PHP {{ number_format($bill->amount, 2) }}</p>
        </div>

        <!-- Billing Month -->
        <div class="rounded-lg border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800 p-6">
            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Billing Month</p>
            <p class="mt-2 text-lg font-semibold text-gray-900 dark:text-white">{{ $bill->billing_month->format('F d, Y') }}</p>
        </div>

        <!-- Due Date -->
        <div class="rounded-lg border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800 p-6">
            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Due Date</p>
            <p class="mt-2 text-lg font-semibold text-gray-900 dark:text-white">{{ $bill->due_date->format('F d, Y') }}</p>
        </div>

        <!-- Status -->
        <div class="rounded-lg border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800 p-6">
            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Status</p>
            @if($bill->status === 'paid')
                <span class="mt-2 inline-flex items-center rounded-full border border-green-200 bg-green-100 px-3 py-1 text-sm font-semibold text-green-800">Paid</span>
            @else
                <span class="mt-2 inline-flex items-center rounded-full border border-red-200 bg-red-100 px-3 py-1 text-sm font-semibold text-red-800">Unpaid</span>
            @endif
        </div>
    </div>

    <!-- Boarder Information -->
    <div class="rounded-lg border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800">
        <div class="border-b border-gray-200 p-4 dark:border-gray-700 sm:p-6">
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Assigned Boarder(s)</h2>
        </div>
        <div class="p-4 sm:p-6">
            @if($bill->room->activeAssignments->count() > 0)
                <div class="space-y-4">
                    @foreach($bill->room->activeAssignments as $assignment)
                        <div class="flex items-center justify-between p-4 border border-gray-200 rounded-lg dark:border-gray-700">
                            <div>
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Boarder Name</p>
                                <p class="mt-1 text-lg font-semibold text-gray-900 dark:text-white">{{ $assignment->boarder->user->name }}</p>
                                <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                                    <span class="font-medium">Assigned since:</span> {{ $assignment->start_date->format('M d, Y') }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-500 dark:text-gray-400">No boarder assigned to this room yet.</p>
            @endif
        </div>
    </div>

    <!-- Timestamp Information -->
    <div class="rounded-lg border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800 p-6">
        <dl class="grid gap-4 sm:grid-cols-2">
            <div>
                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Created</dt>
                <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ $bill->created_at->format('M d, Y \a\t h:i A') }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Last Updated</dt>
                <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ $bill->updated_at->format('M d, Y \a\t h:i A') }}</dd>
            </div>
        </dl>
    </div>
</div>
@endsection
