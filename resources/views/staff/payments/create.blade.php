@extends('staff.layouts.app')

@section('title', 'Record Payment')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-lg shadow p-6">
        <form action="{{ route('staff.payments.store') }}" method="POST">
            @csrf

            <!-- Boarder Selection -->
            <div class="mb-4">
                <label for="boarder_id" class="block text-sm font-medium text-gray-700 mb-1">Select Boarder *</label>
                <select name="boarder_id" id="boarder_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg @error('boarder_id') border-red-500 @enderror" required>
                    <option value="">-- Choose a Boarder --</option>
                    @if($boarder)
                        <option value="{{ $boarder->id }}" selected>{{ $boarder->name }}</option>
                    @else
                        @foreach($boarders as $b)
                            <option value="{{ $b->id }}">{{ $b->name }}</option>
                        @endforeach
                    @endif
                </select>
                @error('boarder_id')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Amount Field -->
            <div class="mb-4">
                <label for="amount" class="block text-sm font-medium text-gray-700 mb-1">Amount (₱) *</label>
                <input type="number" id="amount" name="amount" value="{{ old('amount') }}" step="0.01" min="0" placeholder="0.00" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 @error('amount') border-red-500 @enderror" required>
                @error('amount')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Payment Method -->
            <div class="mb-6">
                <label for="payment_method" class="block text-sm font-medium text-gray-700 mb-1">Payment Method *</label>
                <select name="payment_method" id="payment_method" class="w-full px-4 py-2 border border-gray-300 rounded-lg @error('payment_method') border-red-500 @enderror" required>
                    <option value="">-- Choose Method --</option>
                    <option value="cash" @selected(old('payment_method') === 'cash')>Cash</option>
                    <option value="bank_transfer" @selected(old('payment_method') === 'bank_transfer')>Bank Transfer</option>
                    <option value="check" @selected(old('payment_method') === 'check')>Check</option>
                </select>
                @error('payment_method')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end gap-3">
                <a href="{{ route('staff.payments.index') }}" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                    Cancel
                </a>
                <button type="submit" class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg font-medium">
                    Record Payment
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
