@extends('staff.layouts.app')

@section('title', 'Transaction Details')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-lg shadow p-6">
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-gray-900">Transaction #{{ $transaction->id }}</h2>
            <p class="text-gray-600 text-sm mt-1">{{ $transaction->created_at->format('F d, Y \a\t H:i A') }}</p>
        </div>

        <!-- Transaction Details -->
        <div class="grid grid-cols-2 md:grid-cols-3 gap-6 py-6 border-b border-gray-200">
            <div>
                <p class="text-sm text-gray-600 mb-1">Boarder</p>
                <p class="font-medium text-gray-900">
                    <a href="{{ route('staff.boarders.show', $transaction->boarder) }}" class="text-blue-600 hover:text-blue-800">
                        {{ $transaction->boarder->name }}
                    </a>
                </p>
            </div>
            <div>
                <p class="text-sm text-gray-600 mb-1">Amount</p>
                <p class="text-2xl font-bold text-gray-900">₱{{ number_format($transaction->amount, 2) }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-600 mb-1">Payment Method</p>
                <p class="font-medium text-gray-900 capitalize">{{ str_replace('_', ' ', $transaction->payment_method) }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-600 mb-1">Status</p>
                <p class="font-medium">
                    <span class="px-3 py-1 rounded-full text-xs font-medium
                        @if($transaction->status === 'completed') bg-green-100 text-green-800
                        @elseif($transaction->status === 'pending') bg-yellow-100 text-yellow-800
                        @else bg-red-100 text-red-800
                        @endif
                    ">
                        {{ ucfirst($transaction->status) }}
                    </span>
                </p>
            </div>
            <div>
                <p class="text-sm text-gray-600 mb-1">Processed By</p>
                <p class="font-medium text-gray-900">{{ $transaction->staff->name }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-600 mb-1">Date Recorded</p>
                <p class="font-medium text-gray-900">{{ $transaction->created_at->format('M d, Y') }}</p>
            </div>
        </div>

        <!-- Info Box -->
        <div class="mt-6 p-4 bg-blue-50 border border-blue-200 rounded-lg">
            <p class="text-sm text-blue-800">
                <strong>Note:</strong> Transaction records cannot be modified or deleted. Contact administration if corrections are needed.
            </p>
        </div>

        <!-- Back Button -->
        <div class="mt-6 flex gap-3">
            <a href="{{ route('staff.payments.index') }}" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                ← Back to Payments
            </a>
            <a href="{{ route('staff.boarders.show', $transaction->boarder) }}" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg">
                View Boarder Profile
            </a>
        </div>
    </div>
</div>
@endsection
