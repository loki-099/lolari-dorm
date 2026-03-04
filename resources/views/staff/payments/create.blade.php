@extends('staff.layouts.app')

@section('title', 'Record Payment')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white border border-gray-200 rounded-lg shadow-md p-6">
        <h3 class="text-2xl font-bold text-gray-900 mb-6">Record New Payment</h3>
        
        <form action="{{ route('staff.payments.store') }}" method="POST" class="space-y-5">
            @csrf

            <!-- Boarder Selection -->
            <div>
                <label for="boarder_id" class="block text-sm font-medium text-gray-900 mb-2">Select Boarder <span class="text-red-500">*</span></label>
                <select name="boarder_id" id="boarder_id" class="w-full px-4 py-2.5 text-sm text-gray-900 bg-white border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-600 focus:border-transparent @error('boarder_id') border-red-500 @enderror" required>
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
                    <p class="text-red-500 text-sm mt-2 flex items-center gap-2">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 5v8a2 2 0 01-2 2h-5l-5 4v-4H4a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2zm-11-1a1 1 0 11-2 0 1 1 0 012 0zM10 9a1 1 0 100-2 1 1 0 000 2zm3 1a1 1 0 110-2 1 1 0 010 2z" clip-rule="evenodd"></path></svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Amount Field -->
            <div>
                <label for="amount" class="block text-sm font-medium text-gray-900 mb-2">Amount (₱) <span class="text-red-500">*</span></label>
                <div class="relative">
                    <span class="absolute left-4 top-3 text-gray-600 text-sm font-semibold">₱</span>
                    <input type="number" id="amount" name="amount" value="{{ old('amount') }}" step="0.01" min="0" placeholder="0.00" class="w-full pl-7 pr-4 py-2.5 text-sm text-gray-900 bg-white border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-600 focus:border-transparent @error('amount') border-red-500 @enderror" required>
                </div>
                @error('amount')
                    <p class="text-red-500 text-sm mt-2 flex items-center gap-2">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 5v8a2 2 0 01-2 2h-5l-5 4v-4H4a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2zm-11-1a1 1 0 11-2 0 1 1 0 012 0zM10 9a1 1 0 100-2 1 1 0 000 2zm3 1a1 1 0 110-2 1 1 0 010 2z" clip-rule="evenodd"></path></svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Payment Method -->
            <div>
                <label for="payment_method" class="block text-sm font-medium text-gray-900 mb-2">Payment Method <span class="text-red-500">*</span></label>
                <select name="payment_method" id="payment_method" class="w-full px-4 py-2.5 text-sm text-gray-900 bg-white border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-600 focus:border-transparent @error('payment_method') border-red-500 @enderror" required>
                    <option value="">-- Select Payment Method --</option>
                    <option value="cash" @selected(old('payment_method') === 'cash')>
                        <span class="flex items-center gap-2">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8zm0-13c-2.76 0-5 2.24-5 5s2.24 5 5 5 5-2.24 5-5-2.24-5-5-5z"></path></svg>
                            Cash
                        </span>
                    </option>
                    <option value="bank_transfer" @selected(old('payment_method') === 'bank_transfer')>
                        <span class="flex items-center gap-2">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M4 6h16v2H4zm1 8h2v-2H5zm3 0h2v-2H8zm3 0h2v-2h-2zm3 0h2v-2h-2zm3 0h2v-2h-2zm1 4H4v2h16zm0-8v2h2V6h-2z"></path></svg>
                            Bank Transfer
                        </span>
                    </option>
                    <option value="check" @selected(old('payment_method') === 'check')>
                        <span class="flex items-center gap-2">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41L9 16.17z"></path></svg>
                            Check
                        </span>
                    </option>
                </select>
                @error('payment_method')
                    <p class="text-red-500 text-sm mt-2 flex items-center gap-2">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 5v8a2 2 0 01-2 2h-5l-5 4v-4H4a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2zm-11-1a1 1 0 11-2 0 1 1 0 012 0zM10 9a1 1 0 100-2 1 1 0 000 2zm3 1a1 1 0 110-2 1 1 0 010 2z" clip-rule="evenodd"></path></svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Submit Buttons -->
            <div class="flex justify-end gap-3 pt-4 border-t border-gray-200">
                <a href="{{ route('staff.payments.index') }}" class="inline-flex items-center px-5 py-2.5 text-sm font-medium text-gray-900 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:ring-4 focus:ring-gray-300 transition-all">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                    Cancel
                </a>
                <button type="submit" class="inline-flex items-center px-5 py-2.5 text-sm font-medium text-white bg-green-600 border border-transparent rounded-lg hover:bg-green-700 focus:ring-4 focus:ring-green-300 transition-all">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Record Payment
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
