@extends('staff.layouts.app')

@section('title', 'Payments')

@section('content')
<div class="space-y-6">
    <!-- Add Payment Button -->
    <div class="flex justify-end">
        <a href="{{ route('staff.payments.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 text-sm font-medium text-white bg-green-600 border border-transparent rounded-lg hover:bg-green-700 focus:ring-4 focus:ring-green-300 transition-all">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            <span>Record Payment</span>
        </a>
    </div>

    <!-- Filters Card -->
    <div class="bg-white border border-gray-200 rounded-lg shadow p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Filter Transactions</h3>
        <form action="{{ route('staff.payments.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <!-- Status Filter -->
            <div>
                <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                <select name="status" id="status" class="w-full px-4 py-2 text-sm text-gray-900 bg-white border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-600 focus:border-transparent">
                    <option value="">All Status</option>
                    @foreach(['pending', 'completed', 'failed'] as $s)
                        <option value="{{ $s }}" @selected(request('status') === $s)>{{ ucfirst($s) }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Method Filter -->
            <div>
                <label for="method" class="block text-sm font-medium text-gray-700 mb-2">Payment Method</label>
                <select name="method" id="method" class="w-full px-4 py-2 text-sm text-gray-900 bg-white border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-600 focus:border-transparent">
                    <option value="">All Methods</option>
                    @foreach(['cash', 'bank_transfer', 'check'] as $m)
                        <option value="{{ $m }}" @selected(request('method') === $m)>{{ str_replace('_', ' ', ucfirst($m)) }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Filter Button -->
            <div class="flex items-end">
                <button type="submit" class="w-full px-5 py-2.5 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 transition-all">
                    Apply Filters
                </button>
            </div>
        </form>
    </div>

    <!-- Transactions Table (Read-Only) -->
    <div class="bg-white border border-gray-200 rounded-lg shadow overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs font-semibold text-gray-700 uppercase bg-gray-50 border-b">
                    <tr>
                        <th scope="col" class="px-6 py-3">Date</th>
                        <th scope="col" class="px-6 py-3">Boarder</th>
                        <th scope="col" class="px-6 py-3">Amount</th>
                        <th scope="col" class="px-6 py-3">Method</th>
                        <th scope="col" class="px-6 py-3">Staff</th>
                        <th scope="col" class="px-6 py-3">Status</th>
                        <th scope="col" class="px-6 py-3">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($transactions as $transaction)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 font-medium text-gray-900">{{ $transaction->created_at->format('M d, Y H:i') }}</td>
                            <td class="px-6 py-4 font-medium text-gray-900">{{ $transaction->boarder->name }}</td>
                            <td class="px-6 py-4 font-semibold text-gray-900">₱{{ number_format($transaction->amount, 2) }}</td>
                            <td class="px-6 py-4 text-gray-600">{{ str_replace('_', ' ', ucfirst($transaction->payment_method)) }}</td>
                            <td class="px-6 py-4 text-gray-600">{{ $transaction->staff->name }}</td>
                            <td class="px-6 py-4">
                                @if($transaction->status === 'completed')
                                    <span class="inline-flex items-center px-3 py-1 text-xs font-medium text-green-800 bg-green-100 rounded-full">
                                        <span class="w-2 h-2 bg-green-500 rounded-full mr-2"></span>
                                        Completed
                                    </span>
                                @elseif($transaction->status === 'pending')
                                    <span class="inline-flex items-center px-3 py-1 text-xs font-medium text-amber-800 bg-amber-100 rounded-full">
                                        <span class="w-2 h-2 bg-amber-500 rounded-full mr-2"></span>
                                        Pending
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-3 py-1 text-xs font-medium text-red-800 bg-red-100 rounded-full">
                                        <span class="w-2 h-2 bg-red-500 rounded-full mr-2"></span>
                                        Failed
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <a href="{{ route('staff.payments.show', $transaction) }}" class="text-blue-600 hover:text-blue-800 font-medium transition-colors">View</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-8 text-center">
                                <div class="flex flex-col items-center gap-3">
                                    <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    <p class="text-gray-500">No transactions found</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    @if($transactions->count() > 0)
        <div class="flex justify-center">
            {{ $transactions->links() }}
        </div>
    @endif

    <!-- Note for Staff -->
    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 flex gap-3">
        <svg class="w-5 h-5 text-blue-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M18 5v8a2 2 0 01-2 2h-5l-5 4v-4H4a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2zm-11-1a1 1 0 11-2 0 1 1 0 012 0zM10 9a1 1 0 100-2 1 1 0 000 2zm3 1a1 1 0 110-2 1 1 0 010 2z" clip-rule="evenodd"></path>
        </svg>
        <p class="text-sm text-blue-800">
            <strong>Note:</strong> You can view transaction details, but cannot edit or delete transaction records. Contact administration for refunds or corrections.
        </p>
    </div>
</div>
@endsection
