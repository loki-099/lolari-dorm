@extends('staff.layouts.app')

@section('title', 'Payments')

@section('content')
<div class="space-y-6">
    <!-- Add Payment Button -->
    <div class="flex justify-end">
        <a href="{{ route('staff.payments.create') }}" class="bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded-lg">
            + Record Payment
        </a>
    </div>

    <!-- Filters -->
    <div class="bg-white rounded-lg shadow p-4">
        <form action="{{ route('staff.payments.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <!-- Status Filter -->
            <div>
                <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                <select name="status" id="status" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                    <option value="">All Status</option>
                    @foreach(['pending', 'completed', 'failed'] as $s)
                        <option value="{{ $s }}" @selected(request('status') === $s)>{{ ucfirst($s) }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Method Filter -->
            <div>
                <label for="method" class="block text-sm font-medium text-gray-700 mb-1">Payment Method</label>
                <select name="method" id="method" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                    <option value="">All Methods</option>
                    @foreach(['cash', 'bank_transfer', 'check'] as $m)
                        <option value="{{ $m }}" @selected(request('method') === $m)>{{ str_replace('_', ' ', ucfirst($m)) }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Filter Button -->
            <div class="flex items-end">
                <button type="submit" class="w-full px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium">
                    Filter
                </button>
            </div>
        </form>
    </div>

    <!-- Transactions Table (Read-Only) -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Date</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Boarder</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Amount</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Method</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Staff</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($transactions as $transaction)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 text-sm text-gray-900">{{ $transaction->created_at->format('M d, Y H:i') }}</td>
                        <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $transaction->boarder->name }}</td>
                        <td class="px-6 py-4 text-sm font-medium text-gray-900">₱{{ number_format($transaction->amount, 2) }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ str_replace('_', ' ', ucfirst($transaction->payment_method)) }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $transaction->staff->name }}</td>
                        <td class="px-6 py-4 text-sm">
                            <span class="px-2 py-1 rounded-full text-xs font-medium
                                @if($transaction->status === 'completed') bg-green-100 text-green-800
                                @elseif($transaction->status === 'pending') bg-yellow-100 text-yellow-800
                                @else bg-red-100 text-red-800
                                @endif
                            ">
                                {{ ucfirst($transaction->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm">
                            <a href="{{ route('staff.payments.show', $transaction) }}" class="text-blue-600 hover:text-blue-800">View</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-4 text-center text-gray-500">No transactions yet</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if($transactions->count() > 0)
        <div class="flex justify-center">
            {{ $transactions->links() }}
        </div>
    @endif

    <!-- Note for Staff -->
    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
        <p class="text-sm text-blue-800">
            <strong>Note:</strong> You can view transaction details, but cannot edit or delete transaction records. Contact administration for refunds or corrections.
        </p>
    </div>
</div>
@endsection
