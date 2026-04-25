@extends('layouts.admin')

@section('title', 'Edit Bill')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 sm:p-6 dark:bg-gray-800 mt-2">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.bills.index') }}" class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </a>
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Edit Bill</h1>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Update utility bill details.</p>
            </div>
        </div>
    </div>

    <!-- Error Messages -->
    @if ($errors->any())
        <div class="rounded-lg border border-red-200 bg-red-50 p-4 dark:border-red-800 dark:bg-red-900/30">
            <h3 class="text-sm font-medium text-red-800 dark:text-red-300">Please fix the following errors:</h3>
            <ul class="mt-2 list-inside space-y-1 text-sm text-red-700 dark:text-red-400">
                @foreach ($errors->all() as $error)
                    <li>• {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Form -->
    <form action="{{ route('admin.bills.update', $bill) }}" method="POST" class="overflow-hidden rounded-lg border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800">
        @csrf
        @method('PUT')
        <div class="space-y-6 p-4 sm:p-6">
            <!-- Room Selection -->
            <div>
                <label for="room_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Room <span class="text-red-500">*</span>
                </label>
                <select id="room_id" name="room_id" required class="w-full rounded-lg border border-gray-300 bg-white px-4 py-2 text-gray-900 placeholder-gray-500 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 @error('room_id') border-red-500 @enderror">
                    <option value="">Select a room</option>
                    @foreach($rooms as $room)
                        <option value="{{ $room->id }}" {{ old('room_id', $bill->room_id) == $room->id ? 'selected' : '' }}>
                            Room {{ $room->number }}
                            @if($room->activeAssignments->count() > 0)
                                ({{ $room->activeAssignments->count() }})
                            @else
                                (No boarder)
                            @endif
                        </option>
                    @endforeach
                </select>
                @error('room_id')
                    <p class="mt-1 text-sm text-red-500 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Bill Type -->
            <div>
                <label for="type" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Bill Type <span class="text-red-500">*</span>
                </label>
                <select id="type" name="type" required class="w-full rounded-lg border border-gray-300 bg-white px-4 py-2 text-gray-900 placeholder-gray-500 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 @error('type') border-red-500 @enderror">
                    <option value="">Select bill type</option>
                    <option value="electricity" {{ old('type', $bill->type) == 'electricity' ? 'selected' : '' }}>Electricity</option>
                    <option value="water" {{ old('type', $bill->type) == 'water' ? 'selected' : '' }}>Water</option>
                    <option value="internet" {{ old('type', $bill->type) == 'internet' ? 'selected' : '' }}>Internet</option>
                </select>
                @error('type')
                    <p class="mt-1 text-sm text-red-500 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Amount -->
            <div>
                <label for="amount" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Amount (PHP) <span class="text-red-500">*</span>
                </label>
                <input type="number" id="amount" name="amount" step="0.01" min="0" required value="{{ old('amount', $bill->amount) }}" placeholder="0.00" class="w-full rounded-lg border border-gray-300 bg-white px-4 py-2 text-gray-900 placeholder-gray-500 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 @error('amount') border-red-500 @enderror">
                @error('amount')
                    <p class="mt-1 text-sm text-red-500 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Billing Month -->
            <div>
                <label for="billing_month" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Billing Month <span class="text-red-500">*</span>
                </label>
                <input type="date" id="billing_month" name="billing_month" required value="{{ old('billing_month', $bill->billing_month->format('Y-m-d')) }}" class="w-full rounded-lg border border-gray-300 bg-white px-4 py-2 text-gray-900 placeholder-gray-500 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 @error('billing_month') border-red-500 @enderror">
                @error('billing_month')
                    <p class="mt-1 text-sm text-red-500 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Due Date -->
            <div>
                <label for="due_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Due Date <span class="text-red-500">*</span>
                </label>
                <input type="date" id="due_date" name="due_date" required value="{{ old('due_date', $bill->due_date->format('Y-m-d')) }}" class="w-full rounded-lg border border-gray-300 bg-white px-4 py-2 text-gray-900 placeholder-gray-500 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 @error('due_date') border-red-500 @enderror">
                @error('due_date')
                    <p class="mt-1 text-sm text-red-500 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Status -->
            <div>
                <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Status <span class="text-red-500">*</span>
                </label>
                <select id="status" name="status" required class="w-full rounded-lg border border-gray-300 bg-white px-4 py-2 text-gray-900 placeholder-gray-500 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 @error('status') border-red-500 @enderror">
                    <option value="">Select status</option>
                    <option value="unpaid" {{ old('status', $bill->status) == 'unpaid' ? 'selected' : '' }}>Unpaid</option>
                    <option value="paid" {{ old('status', $bill->status) == 'paid' ? 'selected' : '' }}>Paid</option>
                </select>
                @error('status')
                    <p class="mt-1 text-sm text-red-500 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Form Actions -->
        <div class="flex gap-3 border-t border-gray-200 bg-gray-50 p-4 dark:border-gray-700 dark:bg-gray-700 sm:p-6">
            <button type="submit" class="inline-flex items-center justify-center gap-2 rounded-lg bg-blue-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                Update Bill
            </button>
            <a href="{{ route('admin.bills.index') }}" class="inline-flex items-center justify-center gap-2 rounded-lg bg-gray-300 px-5 py-2.5 text-sm font-medium text-gray-800 hover:bg-gray-400 focus:ring-4 focus:ring-gray-200 dark:bg-gray-600 dark:text-white dark:hover:bg-gray-700 dark:focus:ring-gray-800">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection
