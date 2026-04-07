@extends('layouts.boarder')

@section('content')
    <div class="p-4 border-1 border-default border-dashed rounded-base min-h-screen">
        @if ($transactions)
            <div class="bg-neutral-primary-soft block p-6 border border-default rounded-base shadow-md">
                <div class="mb-4"> 
                    <h2 class="text-xl font-bold text-heading">Transaction History</h2>
                    <p class="text-body text-sm">View all transactions history.</p>
                </div>
                <div class="relative overflow-x-auto bg-neutral-primary-soft shadow-md rounded-base border border-default">
                    <table class="w-full text-sm text-left rtl:text-right text-body">
                        <thead class="text-sm text-body bg-neutral-tertiary border-b rounded-base border-default">
                            <tr>
                                <th scope="col" class="px-6 py-3 font-medium">
                                    Type
                                </th>
                                <th scope="col" class="px-6 py-3 font-medium">
                                    Received By
                                </th>
                                <th scope="col" class="px-6 py-3 font-medium">
                                    Amount
                                </th>
                                <th scope="col" class="px-6 py-3 font-medium">
                                    Method
                                </th>
                                <th scope="col" class="px-6 py-3 font-medium">
                                    Status
                                </th>
                                <th scope="col" class="px-6 py-3 font-medium">
                                    Date
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transactions as $transaction)
                                <tr class="bg-neutral-secondary-soft border-b border-default">
                                    <th scope="row" class="px-6 py-4 font-medium text-heading whitespace-nowrap">
                                        {{ ucfirst($transaction->type) }}
                                    </th>
                                    <td class="px-6 py-4 font-medium text-body whitespace-nowrap">
                                        {{ $transaction->staff->user->first_name . ' ' . $transaction->staff->user->last_name }}
                                    </td>
                                    <td class="px-6 py-4 font-medium text-body whitespace-nowrap">
                                        <span
                                            class="text- font-semibold text-green-600 dark:text-green-400">₱{{ number_format($transaction->amount, 2) }}</span>
                                    </td>
                                    <td class="px-6 py-4 font-medium text-body whitespace-nowrap">
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400 border border-blue-200 dark:border-blue-800">
                                            {{ $transaction->payment_method === 'cash' ? 'Cash' : 'E-wallet' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 font-medium text-body whitespace-nowrap">
                                        @if ($transaction->status === 'completed')
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400 border border-green-200 dark:border-green-800">
                                                <span class="w-1.5 h-1.5 bg-green-500 rounded-full mr-1.5"></span>
                                                Completed
                                            </span>
                                        @elseif($transaction->status === 'pending')
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-100 text-amber-800 dark:bg-amber-900/30 dark:text-amber-400 border border-amber-200 dark:border-amber-800">
                                                <span class="w-1.5 h-1.5 bg-amber-500 rounded-full mr-1.5"></span>
                                                Pending
                                            </span>
                                        @else
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400 border border-red-200 dark:border-red-800">
                                                <span class="w-1.5 h-1.5 bg-red-500 rounded-full mr-1.5"></span>
                                                Failed
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 font-medium text-body whitespace-nowrap">
                                        {{ $transaction->created_at->format('F d, Y h:i A') }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @else
            <div class="flex items-center justify-center min-h-32 rounded-base bg-neutral-secondary-soft mb-4">
                <p class="text-fg-disabled">
                    No transactions found.
                </p>
            </div>
        @endif
    </div>
@endsection
