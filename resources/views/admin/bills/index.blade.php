@extends('layouts.admin')

@section('title', 'Bills')

@section('content')
<div class="space-y-6">
    <!-- Header Section -->
    <div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 sm:p-6 dark:bg-gray-800 mt-2">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Utility Bills</h1>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Manage utility bills for rooms and boarders.</p>
            </div>
            <a href="{{ route('admin.bills.create') }}" class="inline-flex items-center justify-center gap-2 rounded-lg bg-blue-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Add Bill
            </a>
        </div>
    </div>

    <!-- Messages -->
    @if (session('success'))
        <div class="rounded-lg border border-green-200 bg-green-50 p-4 text-sm text-green-800 dark:border-green-800 dark:bg-green-900/30 dark:text-green-300">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="rounded-lg border border-red-200 bg-red-50 p-4 text-sm text-red-800 dark:border-red-800 dark:bg-red-900/30 dark:text-red-300">
            {{ session('error') }}
        </div>
    @endif

    <!-- Filters Section -->
    <div class="overflow-hidden rounded-lg border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800">
        <div class="p-4 sm:p-6">
            <h3 class="mb-4 text-lg font-semibold text-gray-900 dark:text-white">Filters</h3>
            <form method="GET" action="{{ route('admin.bills.index') }}" class="grid gap-4 sm:grid-cols-3">
                <!-- Room Filter -->
                <div>
                    <label for="room_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Room</label>
                    <select id="room_id" name="room_id" class="w-full rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm text-gray-900 placeholder-gray-500 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400">
                        <option value="">All Rooms</option>
                        @foreach($rooms as $room)
                            <option value="{{ $room->id }}" {{ request('room_id') == $room->id ? 'selected' : '' }}>
                                Room {{ $room->number }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Type Filter -->
                <div>
                    <label for="type" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Type</label>
                    <select id="type" name="type" class="w-full rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm text-gray-900 placeholder-gray-500 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400">
                        <option value="">All Types</option>
                        <option value="electricity" {{ request('type') == 'electricity' ? 'selected' : '' }}>Electricity</option>
                        <option value="water" {{ request('type') == 'water' ? 'selected' : '' }}>Water</option>
                        <option value="internet" {{ request('type') == 'internet' ? 'selected' : '' }}>Internet</option>
                    </select>
                </div>

                <!-- Status Filter -->
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Status</label>
                    <select id="status" name="status" class="w-full rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm text-gray-900 placeholder-gray-500 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400">
                        <option value="">All Status</option>
                        <option value="paid" {{ request('status') == 'paid' ? 'selected' : '' }}>Paid</option>
                        <option value="unpaid" {{ request('status') == 'unpaid' ? 'selected' : '' }}>Unpaid</option>
                    </select>
                </div>

                <!-- Filter Button -->
                <div class="sm:col-span-3 flex gap-2">
                    <button type="submit" class="inline-flex items-center justify-center rounded-lg bg-blue-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                        </svg>
                        Filter
                    </button>
                    <a href="{{ route('admin.bills.index') }}" class="inline-flex items-center justify-center rounded-lg bg-gray-300 px-5 py-2.5 text-sm font-medium text-gray-800 hover:bg-gray-400 focus:ring-4 focus:ring-gray-200 dark:bg-gray-600 dark:text-white dark:hover:bg-gray-700 dark:focus:ring-gray-800">
                        Clear
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Bills Table -->
    <div class="overflow-hidden rounded-lg border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800">
        <div class="relative overflow-x-auto">
            <table class="w-full text-left text-sm text-gray-500 dark:text-gray-400">
                <thead class="bg-gray-50 text-xs uppercase text-gray-700 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th class="px-6 py-3">Room</th>
                        <th class="px-6 py-3">Boarder</th>
                        <th class="px-6 py-3">Type</th>
                        <th class="px-6 py-3">Amount</th>
                        <th class="px-6 py-3">Billing Month</th>
                        <th class="px-6 py-3">Due Date</th>
                        <th class="px-6 py-3">Status</th>
                        <th class="px-6 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse($bills as $bill)
                        <tr class="bg-white transition-colors hover:bg-gray-50 dark:bg-gray-800 dark:hover:bg-gray-700">
                            <!-- Room Number -->
                            <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                                Room {{ $bill->room->number }}
                            </td>

                            <!-- Boarder Name -->
                            <td class="px-6 py-4">
                                @if($bill->room->activeAssignments->count() > 0)
                                    @foreach($bill->room->activeAssignments as $assignment)
                                        <div class="text-gray-900 dark:text-white">
                                            {{ $assignment->boarder->user->first_name ?? 'N/A' }} {{ $assignment->boarder->user->last_name ?? 'N/A' }}
                                        </div>
                                    @endforeach
                                @else
                                    <span class="text-gray-400 dark:text-gray-500">No assigned</span>
                                @endif
                            </td>

                            <!-- Bill Type -->
                            <td class="px-6 py-4">
                                @php
                                    $typeColors = [
                                        'electricity' => ['bg' => 'bg-yellow-100', 'text' => 'text-yellow-800', 'dark_bg' => 'dark:bg-yellow-900/30', 'dark_text' => 'dark:text-yellow-300'],
                                        'water' => ['bg' => 'bg-blue-100', 'text' => 'text-blue-800', 'dark_bg' => 'dark:bg-blue-900/30', 'dark_text' => 'dark:text-blue-300'],
                                        'internet' => ['bg' => 'bg-purple-100', 'text' => 'text-purple-800', 'dark_bg' => 'dark:bg-purple-900/30', 'dark_text' => 'dark:text-purple-300'],
                                    ];
                                    $colors = $typeColors[$bill->type] ?? $typeColors['electricity'];
                                @endphp
                                <span class="inline-flex items-center rounded-full border {{ $colors['bg'] }} px-2.5 py-0.5 text-xs font-medium {{ $colors['text'] }} border-{{ $bill->type }}-200 {{ $colors['dark_bg'] }} {{ $colors['dark_text'] }} dark:border-{{ $bill->type }}-800">
                                    {{ ucfirst($bill->type) }}
                                </span>
                            </td>

                            <!-- Amount -->
                            <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                                PHP {{ number_format($bill->amount, 2) }}
                            </td>

                            <!-- Billing Month -->
                            <td class="px-6 py-4">
                                {{ $bill->billing_month?->format('M d, Y') ?? 'N/A' }}
                            </td>

                            <!-- Due Date -->
                            <td class="px-6 py-4">
                                {{ $bill->due_date?->format('M d, Y') ?? 'N/A' }}
                            </td>

                            <!-- Status -->
                            <td class="px-6 py-4">
                                @if($bill->status === 'paid')
                                    <span class="inline-flex items-center rounded-full border border-green-200 bg-green-100 px-2.5 py-0.5 text-xs font-medium text-green-800 dark:border-green-800 dark:bg-green-900/30 dark:text-green-300">Paid</span>
                                @else
                                    <span class="inline-flex items-center rounded-full border border-red-200 bg-red-100 px-2.5 py-0.5 text-xs font-medium text-red-800 dark:border-red-800 dark:bg-red-900/30 dark:text-red-300">Unpaid</span>
                                @endif
                            </td>

                            <!-- Actions -->
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <a href="{{ route('admin.bills.edit', $bill) }}" class="font-medium text-green-600 hover:text-green-800 dark:text-green-400 dark:hover:text-green-300">
                                        Edit
                                    </a>
                                    <form action="{{ route('admin.bills.destroy', $bill) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure? This cannot be undone.');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="font-medium text-red-600 hover:text-red-800 dark:text-red-400 dark:hover:text-red-300">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-6 py-10 text-center text-gray-500 dark:text-gray-400">
                                No bills found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    @if($bills->hasPages())
        <div>
            {{ $bills->links() }}
        </div>
    @endif
</div>
@endsection
