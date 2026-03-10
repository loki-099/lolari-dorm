@extends('layouts.boarder')

@section('content')
    <div class="p-4 border-1 border-default border-dashed rounded-base min-h-screen">
        @if ($transactions)
            <div class="relative overflow-x-auto bg-neutral-primary-soft shadow-xs rounded-base border border-default">
                <table class="w-full text-sm text-left rtl:text-right text-body">
                    <thead class="text-sm text-body bg-neutral-secondary-soft border-b rounded-base border-default">
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
                            <tr class="odd:bg-neutral-primary even:bg-neutral-secondary-soft border-b border-default">
                                <th scope="row" class="px-6 py-4 font-medium text-heading whitespace-nowrap">
                                    {{ ucfirst($transaction->type) }}
                                </th>
                                <td class="px-6 py-4 font-medium text-body whitespace-nowrap">
                                    {{ $transaction->staff->user->first_name . ' ' . $transaction->staff->user->last_name }}
                                </td>
                                <td class="px-6 py-4 font-medium text-body whitespace-nowrap">
                                    {{ $transaction->amount }}
                                </td>
                                <td class="px-6 py-4 font-medium text-body whitespace-nowrap">
                                    {{ ucfirst($transaction->method) }}
                                </td>
                                <td class="px-6 py-4 font-medium text-body whitespace-nowrap">
                                    {{ ucfirst($transaction->status) }}
                                </td>
                                <td class="px-6 py-4 font-medium text-body whitespace-nowrap">
                                    {{ $transaction->created_at->format('F d, Y h:i A') }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
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
